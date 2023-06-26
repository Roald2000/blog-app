<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect(route('auth.login'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $sanitizedInputs = [
            'name' => strip_tags($request->name),
            'email' => strip_tags($request->email),
            'password' => strip_tags(Hash::make($request->password)),
        ];

        // $user = new User();
        // $user->save($sanitizedInputs);

        User::create($sanitizedInputs);

        $credentials['email'] = $sanitizedInputs['email'];
        $credentials['password'] = Hash::make($sanitizedInputs['password']);

        if (Auth::attempt($credentials)) {
            return redirect(route('welcome'))->with('success', 'Login Success!');
        }
        return redirect(route('auth.login'))->with('error', 'Invalid Email/Password!');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $sanitizedInputs = [
            'email' => strip_tags($request['email']),
            'password' => strip_tags($request['password'])
        ];

        if (Auth::attempt($sanitizedInputs)) {
            return redirect(route('welcome'))->with('success', 'Login Success!');
        }
        return redirect(route('auth.login'))->with('error', 'Invalid Email/Password!');
    }
}
