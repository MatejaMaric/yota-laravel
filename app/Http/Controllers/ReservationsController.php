<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function dd;
use function redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\Reservation;
use App\Models\SpecialCall;

class ReservationsController extends Controller
{
    public function index(Request $request)
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

    public function create(Request $request)
    {
        $signs = SpecialCall::all();
        return view('pages.reserve', compact('signs'));
    }

    public function store(Request $request)
    {
        //$validatedData = $request->validate([
            //...
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

        $reservation->specialCall   = $request->scall;
        $reservation->fromTime      = $request->sdate . ' ' . $request->stime;
        $reservation->toTime        = $request->edate . ' ' . $request->etime;
        $reservation->frequencies   = implode(', ', $request->freqs);
        $reservation->modes         = implode(', ', $request->modes);
        $reservation->operatorCall  = $request->ocall;
        $reservation->operatorName  = $request->oname;
        $reservation->operatorEmail = $request->email;
        $reservation->operatorPhone = $request->phone;

        $reservation->saveOrFail();

        return redirect()->route('reserve')->with('status', 'Reservation submitted.');
    }

    // Administration
    public function edit(Request $request)
    {
        $data = Reservation::all();
        return view('pages.reservations', compact('data'));
    }

    public function update(Request $request)
    {
        return Redirect::back();
    }
}
