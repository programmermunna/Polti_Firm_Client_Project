<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public User $userObj;

    public function __construct(User $userObj)
    {
        $this->userObj = new User;
    }

    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => ['required'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $email    = $request->input('email');
        $password = $request->input('password');

        $user = $this->userObj->where('email', $email)->first();

        if(empty($user)){
            return redirect()->back()->with('message', 'You attempt wrong email and password');
        }

        $activeUser = $this->userObj->where('email', $email)->where('password', $password)->where('status', 1)->get();

        if(empty($activeUser)){
            return redirect()->back()->with('message', 'This acount is inactive');
        }

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            // return redirect()->intended('/dashboard');
            return redirect()->intended('/branch');
        }
        return redirect()->back()->with('message', 'Your credentials does not match!');
    }

    /**
     * Logut method
     * public function
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}