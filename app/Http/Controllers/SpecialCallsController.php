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
    public function add(Request $request)
    {
        $data = SpecialCall::all();
        return view('pages.callsigns', compact('data'));
    }
    
    public function addForm(Request $request)
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

        return Redirect::back()->with('status', 'Callsign added.');
    }

    public function edit(Request $request, int $id)
    {
        $data = SpecialCall::findOrFail($id);
        return view('pages.editsign', compact('data'));
    }
    
    public function editForm(Request $request, int $id)
    {
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

        return Redirect::back()->with('statusE', 'Callsign edited.');
    }
}
