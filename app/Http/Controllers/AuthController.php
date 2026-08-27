<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){ return view('auth.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email'=>'required|email','password'=>'required']);
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended($request->user()->role === 'PATIENT' ? route('portal.dashboard') : route('admin.dashboard'));
        }
        return back()->withInput()->with('error','Invalid email or password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','You have been logged out.');
    }

    public function showRegister(){ return view('auth.register'); }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:120',
            'email'=>'required|email|max:190|unique:users,email',
            'phone'=>'required|string|max:30',
            'password'=>'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'=>$data['name'], 'email'=>$data['email'], 'phone'=>$data['phone'],
            'password'=>Hash::make($data['password']), 'role'=>'PATIENT'
        ]);

        $parts = preg_split('/\s+/', trim($data['name']), 2);
        Patient::create([
            'user_id'=>$user->id,
            'patient_number'=>'RC-PT-'.date('Y').'-'.str_pad((string)$user->id,6,'0',STR_PAD_LEFT),
            'first_name'=>$parts[0],
            'last_name'=>$parts[1] ?? '',
            'phone'=>$data['phone'],
            'email'=>$data['email'],
            'status'=>'active'
        ]);

        Auth::login($user);
        return redirect()->route('portal.dashboard')->with('success','Account created successfully.');
    }
}
