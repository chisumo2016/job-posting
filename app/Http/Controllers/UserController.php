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
}
