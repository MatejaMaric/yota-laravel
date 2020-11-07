<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use dd;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::paginate(9);
        return view('pages.gallery', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.gallery-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'images' => 'required'
        ]);
        $images = $request->file('images');
        foreach ($images as $image) {
            $path = 'imgs/';
            $name = time() . '.' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs($path, $name, 'public');

            $save = new Image();
            $save->path = $path;
            $save->name = $name;
            $save->save();
        }

        return Redirect::back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = Image::findOrFail($id);
        $path = $img->path . $img->name;
        $img->delete();
        Storage::disk('public')->delete($path);
        return Redirect::back()->with('status', 'Image deleted.');
    }
}
