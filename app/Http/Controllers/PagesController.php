<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use function dd;
use function redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request)
    {
        Auth::logout();
        return Redirect::back();
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

        return redirect('reserve')->with('status', 'Reservation submitted.');
    }

    public function loginForm(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'Your email address is required.',
            'password.required' => 'Your password is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        //$validatedData = $request->validate([
            //'email' => 'required|email',
            //'password' => 'required',
        //]);
        //return redirect('login')->with('status', 'Submitted.');
        //return Redirect::back()->with('status', 'Submitted.');
        if (Auth::attempt($request->only('email', 'password')))
            return redirect()->intended(route('home'));
        else return Redirect::back()
            ->withErrors(['failed' => ['Bad credentials!']]);
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
