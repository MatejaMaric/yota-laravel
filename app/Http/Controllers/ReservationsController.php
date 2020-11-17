<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function GuzzleHttp\json_encode;
use function dd;
use function redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\Reservation;
use App\Models\SpecialCall;
use function response;

class ReservationsController extends Controller
{
    public function index(Request $request)
    {
        //$activities = Reservation::addSelect([
            //'specialCall' => SpecialCall::select('sign')
                ////->whereColumn('reservations.specialCall', 'special_calls.id')
                //->whereColumn('specialCall', 'id')
                //->limit(1)
        //])->get();
        if ($request->isMethod('post')) {

            $request->validate([
                'call-sign' => 'required|alphanum'
            ]);

            if ($request->input('call-sign') == 'all') {
                $activities = Reservation::where('approved', '1')
                    ->select('operatorCall', 'fromTime', 'toTime', 'specialCall', 'frequencies', 'qso')
                    ->orderBy('fromTime', 'asc')
                    ->get()->toArray();
                $data = [
                    'status' => 'OK',
                    'data' => $activities
                ];

                return response($data);
            } else {
                $activities = Reservation::where('approved', '1')
                    ->select('operatorCall', 'fromTime', 'toTime', 'specialCall', 'frequencies', 'qso')
                    ->where('specialCall', $request->input('call-sign'))
                    ->orderBy('fromTime', 'asc')
                    ->get()
                    ->toArray();
                $data = [
                    'status' => 'OK',
                    'data' => $activities
                ];

                return response($data);
            }
        } else if ($request->isMethod('get')) {
            $signs = SpecialCall::all(); 
            return view('pages.activities', compact('signs'));
        }
    }

    public function create(Request $request)
    {
        $signs = SpecialCall::all();

        $freq_list = [
          '1.8 MHz',
          '3.5 MHz',
          '7 MHz',
          '10 MHz',
          '14 MHz',
          '18 MHz',
          '21 MHz',
          '24 MHz',
          '28 MHz',
          '50 MHz',
          '144 MHz',
          '432 MHz',
          '1.2 GHz',
          '2.3 GHz'
        ];

        $mode_list = [
          'CW' => 'CW',
          'SSB' => 'SSB',
          'FM' => 'FM',
          'RTTY' => 'RTTY',
          'MFSK' => 'MFSK (JT65, FT8...)',
          'IMAGING' => 'IMAGING (ATV, SSTV...)',
          'OTHER DIGITAL' => 'OTHER DIGITAL'
        ];

        $data = [
            'signs' => $signs,
            'freq_list' => $freq_list,
            'mode_list' => $mode_list
        ];

        return view('pages.reserve', $data);
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

        $validator->after(function ($validator) use ($request) {
            $fromStamp = strtotime($request->sdate . ' ' . $request->stime);
            $toStamp = strtotime($request->edate . ' ' . $request->etime);
            if (!($fromStamp < $toStamp)) {
                $validator->errors()->add('time', 'Start date and time needs to be before end date and time.');
            }
        });

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
        if ($request->isMethod('post')) {

            $request->validate([
                'call-sign' => 'required|alphanum'
            ]);

            if ($request->input('call-sign') == 'all') {
                $activities = Reservation::orderBy('id', 'desc')
                    ->get()
                    ->toArray();
                $data = [
                    'status' => 'OK',
                    'data' => $activities
                ];

                return response($data);
            } else {
                $activities = Reservation::where('specialCall', $request->input('call-sign'))
                    ->orderBy('id', 'desc')
                    ->get()
                    ->toArray();
                $data = [
                    'status' => 'OK',
                    'data' => $activities
                ];

                return response($data);
            }
            
        }
        else {
            //$data = Reservation::orderBy('id', 'desc')->get();
            $signs = SpecialCall::all(); 
            return view('pages.reservations', compact('signs'));
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'action' => 'required',
            'id' => 'required|numeric',
            'qso' => 'required|numeric',
            'approved' => 'required',
            'specialCall' => 'required|alphanum',
            'fromTime' => 'required|date',
            'toTime' => 'required|date|after:fromTime',
            'frequencies' => 'required',
            'modes' => 'required',
            'operatorCall' => 'required|alphanum',
            'operatorName' => 'required',
            'operatorEmail' => 'required|email',
            'operatorPhone' => ['required', 'regex:/^[0-9 ]+$/'],
        ];
        $validatedData = $request->validate($rules);

        $record = Reservation::findOrFail($request->id);

        if ($request->action == "update") {
            $record->approved = filter_var($request->approved, FILTER_VALIDATE_BOOLEAN);
            $record->qso = $request->qso;
            $record->specialCall = $request->specialCall;
            $record->fromTime = $request->fromTime;
            $record->toTime = $request->toTime;
            $record->frequencies = $request->frequencies;
            $record->modes = $request->modes;
            $record->operatorCall = $request->operatorCall;
            $record->operatorName = $request->operatorName;
            $record->operatorEmail = $request->operatorEmail;
            $record->operatorPhone = $request->operatorPhone;
            $record->saveOrFail();
            
            return response()->json(['action' => $request->input('action')]);

        } else if ($request->action == "restore") {
            $resp = $record->toArray();
            $resp['action'] = $request->input('action');

            return response()->json($resp);

        } else if ($request->action == "delete") {
            $record->delete();
            
            return response()->json(['action' => $request->input('action')]);

        } else {
            return response()->json(['action' => 'error']);
        }
    }
}
