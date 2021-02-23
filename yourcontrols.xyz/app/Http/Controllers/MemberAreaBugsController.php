<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberAreaBugsController extends Controller
{
    public function index()
    {
        return Inertia::render("member-area/index")->withViewData([
            "pageTitle" => "Home"
        ]);
    }
}
