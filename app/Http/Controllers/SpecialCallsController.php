<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function dd;
use function redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Models\Reservation;

class SpecialCallsController extends Controller
{
    public function activities(Request $request)
    {
        $activities = Reservation::all();
        return view('pages.activities', compact('activities'));
    }

    public function reserve(Request $request)
    {
        return view('pages.reserve');
    }

    public function reserveForm(Request $request)
    {
        //$validatedData = $request->validate([
            //'scall' => 'required|alphanum',
            //'sdate' => 'required|date',
            //'stime' => 'required',
            //'edate' => 'required|date',
            //'etime' => 'required',
            //'freqs' => 'required',
            //'modes' => 'required',
            //'ocall' => 'required|alphanum',
            //'oname' => 'required',
            //'email' => 'required|email',
            //'phone' => ['required', 'regex:/^[0-9 ]+$/'],
        //]);

        $rules = [
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
        ];

        $messages = [
            'freqs.required' => 'You need to choose at least one frequency.',
            'modes.required' => 'You need to choose at least one mode.',
            'ocall.alphanum' => 'Callsigns must be alpha-numeric!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $reservation = new Reservation();

        $reservation->specialCall = 1;
        $reservation->fromTime = $request->sdate . ' ' . $request->stime;
        $reservation->toTime   = $request->edate . ' ' . $request->etime;
        $reservation->frequencies = implode(', ', $request->freqs);
        $reservation->modes       = implode(', ', $request->modes);
        $reservation->operatorCall  = $request->ocall;
        $reservation->operatorName  = $request->oname;
        $reservation->operatorEmail = $request->email;
        $reservation->operatorPhone = $request->phone;

        $reservation->saveOrFail();

        return redirect()->route('reserve')->with('status', 'Reservation submitted.');
    }
}
