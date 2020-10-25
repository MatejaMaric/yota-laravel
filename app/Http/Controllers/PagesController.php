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

        $validatedData = $request->validate([
            'scall' => 'required|alphanum',
            'sdate' => 'required|date',
            'stime' => 'required',
            'edate' => 'required|date',
            'etime' => 'required',
            'freqs' => 'required',
            'modes' => 'required',
            'ocall' => 'required|alphanum',
            'oname' => 'required',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^[0-9 ]+$/'],
        ]);

/*
            $table->id();
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('specialCall');
            $table->dateTime('fromTime');
            $table->dateTime('toTime');
            $table->string('frequencies', 255);
            $table->string('modes', 255);
            $table->string('operatorCall');
            $table->string('operatorName');
            $table->string('operatorEmail');
            $table->string('operatorPhone', 50);
            $table->integer('qso')->default(0);
            $table->timestamps();
            $table->foreign('specialCall')->references('id')->on('special_calls');
*/

        return redirect('reserve')->with('status', 'Reservation submitted.');
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function loginForm(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        return redirect('login')->with('status', 'Submitted.');
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
