<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function dd;
use function redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('pages.login');
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

    public function logout(Request $request)
    {
        Auth::logout();
        return Redirect::back();
    }
}
