<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CircuitResource;
use App\Models\Circuit;
use App\TokenValidation;
use Illuminate\Http\Request;

class CircuitController extends Controller
{
    use TokenValidation;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // return $this->validateToken($request, function ($visitor) {
            $circuits = Circuit::where('published', 1)->get();
            return CircuitResource::collection($circuits);
        // });
    }

    public function getAudio(Request $request, $name) {
        // $audio = Audio::find($name);
        // dd($name);
        return response()->file(storage_path("app/public/audios/{$name}"), [
            'Content-Type' => 'audio/mp3',
            'Accept-Ranges' => 'bytes',
            'Content-Length' => filesize(storage_path("app/public/audios/{$name}")),
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
