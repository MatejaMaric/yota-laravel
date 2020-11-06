<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function dd;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\Post;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Post::orderBy('created_at', 'desc')->paginate(6);

        //$data = ['news' => $news];
        //return view('pages.news')->with($data);
        //return view('pages.news')->with('news', $news);
        return view('pages.news', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Post::orderBy('created_at', 'desc')->get();
        return view('pages.news-admin', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'text' => 'required'
        ];
        $messages = [
            'sign.required' => 'You need to provide a title!',
            'text.required' => 'Your post needs to have some information!'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post();
        $post->title = $request->title;
        $post->author = $request->author;
        $post->text = $request->text;
        $post->saveOrFail();

        return Redirect::back()->with('status', "New post added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::findOrFail($id);
        return view('pages.editpost', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('submit') == 'Edit post') {
            $rules = [
                'title' => 'required',
                'text' => 'required'
            ];
            $messages = [
                'sign.required' => 'You need to provide a title!',
                'text.required' => 'Your post needs to have some information!'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->author = $request->author;
            $post->text = $request->text;
            $post->saveOrFail();

            return Redirect::route('newsAdd')->with('statusE', "Post edited.");
        } else return Redirect::route('newsAdd');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $title = $post->title;
        $post->delete();
        return Redirect::back()->with('statusE', "Post \"$title\" deleted.");
    }
}
