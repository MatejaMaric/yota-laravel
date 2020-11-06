<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function dd;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.index');
    }

    public function sponsoring(Request $request)
    {
        return view('pages.sponsoring');
    }
}
