<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models as models;
use App\TokenValidation;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
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
    public function store(Request $request, string $event_id)
    {
        return $this->validateToken(
            $request,
            function (models\Visitor $visitor) use ($event_id) {
                $event = models\Event::find($event_id);

                if (!$event) {
                    return response()->json([
                        'message' => "Event with id '$event_id' not found",
                    ], 404);
                }

                $visitor->events()->attach($event);


                return response()->json([
                    'message' => "Event Has Been Booked Successfully!!",
                ], 200);
            }
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) {
            return EventResource::collection($visitor->events);
        });
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
    public function destroy(Request $request, string $event_id)
    {
        return $this->validateToken(
            $request,
            function (models\Visitor $visitor) use ($event_id) {


                $bookedEvents = DB::table("bookings")->where("visitor_id", $visitor->id);

                if (!$bookedEvents->first()) {
                    return response()->json([
                        'message' => "Visitor hasn't Favorited",
                    ], 404);
                }


                $theEvent = $bookedEvents->where("event_id", $event_id)->first();

                DB::table("bookings")->delete($theEvent->id);

                return response()->json([
                    'message' => "Unbooked '$event_id' Successfully!!",
                ], 200);
            }
        );
    }
}
