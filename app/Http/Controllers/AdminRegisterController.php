<?php

namespace App\Http\Controllers;

use App\Mail\PasswordMail;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AdminRegisterController extends Controller
{
    //

    public function index()
    {
        return view('user.register_user');
    }

    public function store(Request $request)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'gender' => 'required',
        ]);

        $random_password = Str::random(10) . time();

        $user = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email_address' => [
                $request->email
            ],
            'username' => $request->username,
            "password" => $random_password
        ];

        $headers = [
            'Authorization' => 'Bearer sk_test_Al5MqrFlbGJ8KNRutKQJn7o3U6paXeO0zxEQc08qg0',
            'Content-Type' => 'application/json'
        ];

        try {
            $response = Http::withHeaders($headers)->post('https://api.clerk.com/v1/users', $user);
            if ($response->ok()) {
                Mail::to($request->email)->send(new PasswordMail($random_password));
            }
        } catch (\Throwable $e) {
            dd($e, 'errorrrrrr shiiit');
        }

        Visitor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'role' => 'admin',
            'token' => null
        ]);

        User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($random_password),
        ]);

        return back();
    }
}
