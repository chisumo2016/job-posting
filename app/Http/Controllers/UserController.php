<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public  function  create()
    {
        return view('users.register');
    }

    public  function  store(Request $request)
    {
        $validation = $request->validate([
            'name'      => ['required', 'min:3'],
            'email'     => ['required', 'email', Rule::unique('users','email')],
            'password'  => ['required', 'confirmed','min:6'],
        ]);
        //Hash Password

        $validation['password'] = bcrypt($validation['password']);

        $user = User::create($validation);

        //Login
        auth()->login($user);

        return redirect('/')->with('message','User Created and Logged in');
    }

    public  function  logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','You have been logout ');
    }

    public  function  login()
    {
        return view('users.login');
    }

    public  function  authenticate(Request $request)
    {
        $validation = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => 'required',
        ]);

        if (auth()->attempt($validation)){
            $request->session()->regenerate();

            return redirect('/')->with('message','You are now logged in');
        }

        return  back()->withErrors(['email' => 'Invalid  Credentials'])->onlyInput('email');
    }
}
