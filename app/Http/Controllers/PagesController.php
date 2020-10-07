<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function services()
    {
        //$title = 'Some title';
        //return view('pages.index', compact('title'));
        $data = [
            'title' => 'Services',
            'services' => ['Web design', 'Programming', 'SEO']
        ];
        return view('pages.index')->with($data);
    }

    public function about()
    {
        //$title = 'About';
        //return view('pages.index')->with('title', $title);
        $data = ['title' => 'About'];
        return view('pages.index')->with($data);
    }
}
