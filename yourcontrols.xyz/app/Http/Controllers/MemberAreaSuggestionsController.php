<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Suggestion;
use \Godruoyi\Snowflake\Snowflake;
use RestCord\DiscordClient;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class MemberAreaSuggestionsController extends Controller
{
    public function view()
    {
        return Inertia::render("member-area/suggestions/view",[
            "suggestions"=>  QueryBuilder::for(Suggestion::class)
            ->with(['user'])
            ->get()
        ])->withViewData([
            "pageTitle" => "Member Area"
        ]);
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
        $snowflake = new Snowflake();
        $suggestion->snowflake = $snowflake->id();
        $suggestion->title = $data["title"];
        $suggestion->desc = $data["desc"];
        $message = $discord->channel->createMessage([
            'channel.id' => 768361854187470849,
            'embed'      => [
                "title"         => $data["title"],
                "description"   => $data["desc"],
                "color"         => 12118406,
                "author"        => [
                    "name"      => $user->username,
                    "icon_url"  => $user->avatar
                ],
            ]
        ]);
        $suggestion->user_id = $user->id;
        $suggestion->message_id = $message["id"];
        $suggestion->save();
        return redirect()->route('member-area/suggestions/submit');
    }
}
