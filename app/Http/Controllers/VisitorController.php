<?php

namespace App\Http\Controllers;

use App\Models as models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades as facades;
use App\Mail\PasswordMail;
use Illuminate\Support\Str;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("visitors.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gender' => 'required',
        ]);

        $random_password = Str::random(10) . time();

        $response = facades\Http::withHeaders([
            'Authorization' => 'Bearer ' . config("clerk.secret_key"),
            'Content-Type' => 'application/json'
        ])->post('https://api.clerk.com/v1/user', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email_address' => [
                $request->email
            ],
            "password" => $random_password
        ]);

        if (!$response->ok()) {
            throw $response->toException();
        }

        models\Visitor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'role' => 'admin',
            'token' => $response->json()["id"],
            'age' => 'adult',
        ]);

        models\User::create([
            'name' => $request->first_name,
            'email' => $request->email,
            'password' => facades\Hash::make($random_password),
        ]);

        facades\Mail::to($request->email)->send(new PasswordMail($random_password));

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(models\Visitor $visitor)
    {
        return view('visitors.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(models\Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, models\Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(models\Visitor $visitor)
    {
        //
    }
}
