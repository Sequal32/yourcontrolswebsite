<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index() {
        return Inertia::render("index")->withViewData([
            "pageTitle" => "Home"
        ]);
    }
    
    public function changelog() {
        return Inertia::render("changelog")->withViewData([
            "pageTitle" => "Change Log"
        ]);
    }
    
    public function download() {
        return Inertia::render("download")->withViewData([
            "pageTitle" => "Download"
        ]);
    }
}
