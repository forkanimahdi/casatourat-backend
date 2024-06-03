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
use Psy\Exception\ThrowUpException;

use function PHPUnit\Framework\throwException;

class AdminRegisterController extends Controller
{
    //

    public function index()
    {
        return view('user.register_user');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
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
                'Authorization' => 'Bearer ' . config("clerk.secret_key"),
                'Content-Type' => 'application/json'
            ];

            $response = Http::withHeaders($headers)->post('https://api.clerk.com/v1/user', $user);
            
            Visitor::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'role' => 'admin',
                'token' => $response->json()["id"],
            ]);

            User::create([
                'name' => $request->first_name,
                'email' => $request->email,
                'password' => Hash::make($random_password),
            ]);
            Mail::to($request->email)->send(new PasswordMail($random_password));
            return back();
        } catch (\Throwable $e) {
            dump('error', $e);
            return abort(404);
        }
    }
}
