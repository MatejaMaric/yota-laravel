<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('about');
    }

    public function services()
    {
        return view('about');
    }

    public function about()
    {
        return view('about');
    }
}
