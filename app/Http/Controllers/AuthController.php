<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthenticateRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login_index()
    {
        $setting = Setting::where('id', 1)->first();

        return view('pages.auth.login', compact('setting'));
    }

    public function login_authenticate(LoginAuthenticateRequest $request)
    {
        $field = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $field => $request->input('username'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials)) {
            $welcomeText = 'Selamat datang';

            if (auth()->user()->isDepartmentHead()) {
                $welcomeText .= ' di Bidang ' . auth()->user()->departmentHead->department . '!';
            } elseif (auth()->user()->isPic()) {
                $welcomeText .= ' di Bidang ' . auth()->user()->pic->department . '!';
            }

            return redirect()
                ->route('dashboard.index')
                ->withSuccess($welcomeText);
        }

        return redirect()
            ->back()
            ->withErrors(['message' => 'Ups! Username atau password salah']);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()
            ->route('auth.login.index');
    }
}
