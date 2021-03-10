<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Bug;
use \Godruoyi\Snowflake\Snowflake;
use RestCord\DiscordClient;
use Illuminate\Support\Facades\Auth;

class MemberAreaBugsController extends Controller
{
    public function index()
    {
        return Inertia::render("member-area/bugs/index")->withViewData([
            "pageTitle" => "Member Area"
        ]);
    }

    public function get_submit()
    {
        return Inertia::render("member-area/bugs/report")->withViewData([
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
            // echo $index."<br>";
            // echo $file."<br>";
            // Get filename with the extension
            $filenameWithExt = $file->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= base64_encode($filename).''.time().'.'.$extension;
            // Upload Image
            $path = str_replace("public", "storage", $request->file($index)->storeAs('public/log_files', $fileNameToStore));
            array_push($uploadedFiles, $path);
        }
        $uploadedFilesJson = json_encode($uploadedFiles);
        $snowflake = new Snowflake();
        // dd(strtotime(gmdate('Y-m-d H:i:s', time())));
        // $snowflake->setStartTimeStamp(strtotime(gmdate('Y-m-d H:i:s', time())));
        $bug->snowflake = $snowflake->id();
        $bug->title = $data["title"];
        $bug->desc = $data["desc"];
        $bug->steps = $data["steps"];
        $bug->files = $uploadedFilesJson;
        $bug->user_id = $user->discord_id;
        $bug->save();
        $channel = $discord->guild->createGuildChannel([
            "guild.id" => 764805300229636107,
            "name" => "bug-".$bug->id,
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
        // $message = $discord->channel->createMessage([
        $discord->channel->createMessage([
            'channel.id' => $channel->id,
            'embed'      => [
                "description" => $data["desc"] ."\n\n\n" . $files,
                "title" => $data["title"],
                "author" => [
                    "name" => "Bug Report #" . $bug->id,
                ],
                "color" => 0x0f4781,
                "timestamp" => now(),
                "fields" => $fields
            ]
        ]);
        $bug->save();
        // dd($message);
        return redirect()->route('member-area/bugs/submit');
        // return Storage::download($path);
        // return "";
        // return $bug->id;
    }
}
