<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MemberAreaController extends Controller
{
    public function index()
    {
        return Inertia::render("member-area/index")->withViewData([
            "pageTitle" => "Home"
        ]);
    }
}
