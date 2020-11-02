<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function dd;
use function redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\SpecialCall;

class SpecialCallsController extends Controller
{
    public function create(Request $request)
    {
        $data = SpecialCall::all();
        return view('pages.callsigns', compact('data'));
    }
    
    public function store(Request $request)
    {
        $rules = [ 'sign' => 'required' ];
        $messages = [ 'sign.required' => 'You need to provide a callsign!' ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $newcall = new SpecialCall();
        $newcall->sign = strtoupper($request->sign);
        $newcall->description = $request->description;
        $newcall->saveOrFail();

        return Redirect::back()->with('status', "Special callsign added.");
    }

    public function edit(Request $request, int $id)
    {
        $data = SpecialCall::findOrFail($id);
        return view('pages.editsign', compact('data'));
    }
    
    public function update(Request $request, int $id)
    {
        if ($request->input('submit') == 'Edit callsign') {
            $rules = [ 'sign' => 'required' ];
            $messages = [ 'sign.required' => 'You need to provide a callsign!' ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = SpecialCall::findOrFail($id);
            $data->sign = strtoupper($request->sign);
            $data->description = $request->description;
            $data->saveOrFail();

            return Redirect::route('addSign')->with('statusE', "Special callsign edited.");
        } else return Redirect::route('addSign');
    }

    public function delete(Request $request, int $id)
    {
        //SpecialCall::findOrFail($id)->delete();
        $sign = SpecialCall::findOrFail($id);
        $call = $sign->sign;
        $sign->delete();
        return Redirect::back()->with('statusE', "Special callsign $call deleted.");
    }
    
}
