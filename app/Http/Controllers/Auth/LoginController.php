<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        $this->data['headline'] = 'Login';
        return view('login.form', $this->data);
    }

    public function authenticate(LoginRequest $request)
    {
        $formData = $request->only('email','password');

        if (Auth::attempt($formData)){
            return redirect()->intended('/');
        }else{
            return redirect()->route('login')->withErrors('Invalid Email and Password');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
