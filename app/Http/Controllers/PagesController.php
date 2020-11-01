<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function dd;

use App\Models\Post;
use App\Models\Reservation;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.index');
    }

    public function news(Request $request)
    {
        $news = Post::orderBy('created_at', 'desc')->get();

        //$data = ['news' => $news];
        //return view('pages.news')->with($data);
        //return view('pages.news')->with('news', $news);
        return view('pages.news', compact('news'));
    }

    public function gallery(Request $request)
    {
        return view('pages.gallery');
    }

    public function sponsoring(Request $request)
    {
        return view('pages.sponsoring');
    }

    public function activities(Request $request)
    {
        $activities = Reservation::where('approved', '1')->get();
        //$activities = Reservation::addSelect([
            //'specialCall' => SpecialCall::select('sign')
                ////->whereColumn('reservations.specialCall', 'special_calls.id')
                //->whereColumn('specialCall', 'id')
                //->limit(1)
        //])->get();

        return view('pages.activities', compact('activities'));
    }
}
