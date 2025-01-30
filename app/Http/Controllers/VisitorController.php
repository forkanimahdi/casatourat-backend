<?php

namespace App\Http\Controllers;

use App\Models as models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades as facades;
use App\Mail\PasswordMail;
use App\Models\Visitor;
use Exception;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitors = models\Visitor::all();
        return view("visitors.index", compact('visitors'));
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
            'full_name' => 'required',
            // 'last_name' => 'required',
            'email' => 'required',
            'gender' => 'required',
        ]);

        $random_password = Str::random(10);
        try {
            $response = facades\Http::withHeaders([
                'Authorization' => 'Bearer ' . config("clerk.secret_key"),
                'Content-Type' => 'application/json'
            ])->post('https://api.clerk.com/v1/users', [
                'email_address' => [
                    $request->email
                ],
                "password" => $random_password
            ]);

            if (!$response->ok()) {
                throw new Exception($response->json()['errors'][0]['message'] ?? "An unexpected error occurred. Please try again.");
            }

            models\Visitor::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'gender' => $request->gender,
                'role' => 'admin',
                'token' => $response->json()["id"],
            ]);

            models\User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => facades\Hash::make($random_password),
            ]);

            facades\Mail::to($request->email)->send(new PasswordMail($random_password));
            return back()->with("success", "Admin account was created succefully.");
        } catch (\Exception $th) {
            return back()->with("error", $th->getMessage());
        }
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
    public function destroy(string $id)
    {
        $visitor = models\Visitor::find($id);
        $visitor->delete();
        // TODO: delete from clerk as well
        return back()->with('success', 'Visitor Deleted from Database');
    }
}
