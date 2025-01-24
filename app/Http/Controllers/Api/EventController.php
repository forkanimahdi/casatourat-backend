<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use App\TokenValidation;

class EventController extends Controller
{
    use TokenValidation;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getAudio()
    {
        $audio = asset('storage/audios/1727880387_en.mp3');
        return response()->json($audio);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $this->validateToken(
            $request,
            fn() => EventResource::collection(Event::orderBy('created_at', 'desc')->get())
        );
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
