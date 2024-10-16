<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        //get auth user token
        $userToken = Visitor::where('email', Auth::user()->email)->value('token');
        if (!$userToken)
            return back()->with('error', "admin account not found");

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config("clerk.secret_key"),
            'Content-Type' => 'application/json'
        ])->patch('https://api.clerk.com/v1/users/' . $userToken, [
            "password" => $request->password
        ]);

        if (!$response->ok()) {
            return back()->with('error', "error while trying to udpdate password please try again.");
        }

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'password updated');
    }
}
