<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use illuminate\support\Facades\Session;

class AuthManager extends Controller
{
    function login (){
        if (auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }

    function registration (){
        return view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email' , 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Login details are not vaild");
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with("error", "Registration failed, try again!");
        }
        return redirect(route('login'))->with("success", "Registration successful, login to access the app");
    }

    function edit (){
        if (auth::check()){
            return redirect(route('edit'));
        }
        return view('edit');
    }
    
    function logout(){
        Session()->flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
