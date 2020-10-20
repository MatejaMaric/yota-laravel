<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use function dd;
use function redirect;

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

    //--------------------------------------

    public function news(Request $request)
    {
        $news = Post::all();

        //return view('pages.news')->with('news', $news);
        return view('pages.news', compact('news'));
    }

    public function gallery(Request $request)
    {
        return view('pages.gallery');
    }

    public function login(Request $request)
    {
        return view('pages.login');
    }

    public function activities(Request $request)
    {
        return view('pages.activities');
    }

    public function reserve(Request $request)
    {
        return view('pages.reserve');
    }

    public function reserveForm(Request $request)
    {
        //dd($request->input('modes'));
        return redirect('reserve')->with('status', 'Reservation submitted.');
    }

    //public function services()
    //{
        ////$title = 'Some title';
        ////return view('pages.index', compact('title'));
        //$data = [
            //'title' => 'Services',
            //'services' => ['Web design', 'Programming', 'SEO']
        //];
        //return view('pages.services')->with($data);
    //}

    //public function about()
    //{
        ////$title = 'About';
        ////return view('pages.index')->with('title', $title);
        //$data = ['title' => 'About'];
        //return view('pages.index')->with($data);
    //}
}
