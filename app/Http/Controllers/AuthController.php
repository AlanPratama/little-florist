<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function loginIndex()
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('pages.auth.login', compact('carts'));
        } else {
            return view('pages.auth.login');
        }
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $rememberToken = $request->has('remember_token');

        if (Auth::attempt($credentials, $rememberToken)) {
            return redirect()->intended('/')->with('berhasil', 'BERHASIL LOGIN');
        } else {
            return back()->withInput($request->only('username', 'remember_token')) ->with('gagal', 'USERNAME ATAU PASSWORD SALAH!');
        }
    }




    public function registerIndex()
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('pages.auth.register', compact('carts'));
        } else {
            return view('pages.auth.register');
        }
    }

    public function registerProcess(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ];

        User::create($data);

        return redirect()->back()->with('berhasil', 'AKUN BERHASIL DIBUAT! SILAHKAN LOGIN');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginIndex');
    }
}
