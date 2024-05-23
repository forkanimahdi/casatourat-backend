<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\TokenValidation;
use Illuminate\Http\Request;
use App\Models as models;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    use TokenValidation;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $building_id)
    {
        return $this->validateToken($request, function () use ($building_id) {
            $rates = models\Rate::where('building_id', $building_id)->get();
            return $rates->map(fn ($rate) => [
                'id' => $rate->id,
                'rate' => $rate->value,
                'visitor' => [
                    'first_name' => $rate->visitor->first_name,
                    'last_name' => $rate->visitor->last_name,
                ],
            ]);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->validateToken($request, function ($visitor) use ($request) {
            $building = models\Building::find($request->building_id);
            if (!$building) {
                return response()->json([
                    'message' => "building with id '$request->building_id' not found"
                ]);
            }

            models\Rate::updateOrCreate(
                [
                    'visitor_id' => $visitor->id,
                    'building_id' => $request->building_id,
                ],
                [
                    'value' => $request->value,
                ]
            );

            return response()->json([
                'message' => 'Rating stored successfully',
            ]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $rate_id)
    {
        //
    }
}
