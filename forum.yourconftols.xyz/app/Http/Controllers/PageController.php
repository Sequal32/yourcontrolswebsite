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
    public function loginPage() {
        return Inertia::render("Auth/login")->withViewData([
            "pageTitle" => "Login"
        ]);
    }
    public function registerPage() {
        return Inertia::render("Auth/register")->withViewData([
            "pageTitle" => "Register"
        ]);
    }
}
