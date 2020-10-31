<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function dd;
use function redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class SpecialCallsController extends Controller
{
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

        return redirect()->route('reserve')->with('status', 'Reservation submitted.');
    }
}
