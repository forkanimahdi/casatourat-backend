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
     * Send the specified resource.
     */
    public function show(Request $request)
    {
        // Send all the events based on their starting date
        $events = Event::orderBy('start', 'desc')->get();
        return EventResource::collection($events);
    }
}
