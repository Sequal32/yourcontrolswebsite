<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use App\Models\Bug;
use RestCord\DiscordClient;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class MemberAreaBugsController extends Controller
{
    public function get_submit()
    {
        return Inertia::render("member-area/bugs/index")->withViewData([
            "pageTitle" => "Member Area"
        ]);
    }

    public function post_submit(Request $request)
    {
        $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);
        $user = Auth::user();
        $bug = new Bug();
        $files = $request->files;
        $data = $request->only(["title", "desc", "steps"]);
        $uploadedFiles = [];
        foreach ($files as $index => $file) {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore= base64_encode($filename).''.time().'.'.$extension;
            $path = str_replace("public", "storage", $request->file($index)->storeAs('public/log_files', $fileNameToStore));
            array_push($uploadedFiles, $path);
        }
        $uploadedFilesJson = json_encode($uploadedFiles);
        $bug->snowflake = Carbon::now()->timestamp;
        $bug->title = $data["title"];
        $bug->desc = $data["desc"];
        $bug->steps = $data["steps"];
        $bug->files = $uploadedFilesJson;
        $bug->user_id = $user->id;
        $bug->closed = false;
        $bug->save();
        $channel = $discord->guild->createGuildChannel([
            "guild.id" => 764805300229636107,
            "name" => "bug-".$bug->snowflake,
            "type" => 0,
            "parent_id" => 817163288693178438,
        ]);
        $bug->channel_id = "".$channel->id;
        $fields = [];
        foreach(json_decode($data["steps"]) as $index => $value) {
            $field = [
                "name" => "Step ".$value->index,
                "value" => $value->value,
            ];
            array_push($fields, $field);
        }
        $files = "";
        foreach($uploadedFiles as $index => $file) {
            $files .= "[LogFile".$index."](https://site.yourcontrols.xyz/".$file.")\n";
        }
        $discord->channel->createMessage([
            'channel.id' => $channel->id,
            'embed'      => [
                "description" => $data["desc"] ."\n\n\n" . $files,
                "title" => $data["title"],
                "author" => [
                    "name" => "Bug Report #" . $bug->snowflake,
                ],
                "color" => 0x0f4781,
                "timestamp" => now(),
                "fields" => $fields
            ]
        ]);
        $discord->channel->editChannelPermissions([
            'channel.id' => $channel->id,
            "overwrite.id" => (string) $user->discord_id,
            "type" => 1,
            "allow" => 116736
        ]);
        $bug->save();
        return redirect()->route('member-area/bugs/view');
    }

    public function api_paginated_view(Request $request)
    {
        $pagination = 20;

        if (!is_null($request->get('perpage')) && $request->get('perpage') > 0) {
            $pagination = (int)$request->get('perpage');
        }
        $comments = QueryBuilder::for(Bug::class)
        ->with(['user'])
        ->defaultSort('-created_at')
        ->where('closed', 'not', 'true')
        ->paginate($pagination);
        
        return $comments;
    }

    public function view()
    {
        return Inertia::render("member-area/bugs/view")->withViewData([
            "pageTitle" => "Member Area"
        ]);
    }
}
