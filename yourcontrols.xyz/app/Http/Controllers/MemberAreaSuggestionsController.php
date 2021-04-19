<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use App\Models\Suggestion;
use RestCord\DiscordClient;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class MemberAreaSuggestionsController extends Controller
{
    public function view()
    {
        return Inertia::render("member-area/suggestions/view")->withViewData([
            "pageTitle" => "Member Area"
        ]);
    }

    public function api_paginated_view(Request $request)
    {
        $pagination = 20;

        if (!is_null($request->get('perpage')) && $request->get('perpage') > 0) {
            $pagination = (int)$request->get('perpage');
        }

        $comments = QueryBuilder::for(Suggestion::class)
        ->with(['user'])
        ->defaultSort('-created_at')
        ->paginate($pagination);

        return $comments;
    }

    public function get_submit()
    {
        return Inertia::render("member-area/suggestions/index")->withViewData([
            "pageTitle" => "Member Area"
        ]);
    }

    public function post_submit(Request $request)
    {
        $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);
        $user = Auth::user();
        $suggestion = new Suggestion();
        $data = $request->only(["title", "desc"]);
        $suggestion->snowflake = Carbon::now()->timestamp;
        $suggestion->title = $data["title"];
        $suggestion->desc = $data["desc"];
        $message = $discord->channel->createMessage([
            'channel.id' => 833804609666547733,
            'embed'      => [
                "title"         => $data["title"],
                "description"   => $data["desc"],
                "color"         => 0x0f4781,
                "author"        => [
                    "name"      => "New Suggestion",
                ],
                "footer"        => [
                    "text"      => "Suggestion by ".$user->username,
                    "icon_url"  => $user->avatar
                ]
            ]
        ]);
        $suggestion->user_id = $user->id;
        $suggestion->message_id = $message["id"];
        $suggestion->save();
        return redirect()->route('member-area/suggestions/view');
    }
}
