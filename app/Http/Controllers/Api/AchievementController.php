<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Models\Achievement;
use App\Models\Building;
use App\TokenValidation;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    use TokenValidation;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->validateToken($request, fn ($visitor) => BuildingResource::collection($visitor->visits));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->validateToken($request, function ($visitor)  use ($request) {

            $is_has_achievement = Achievement::where('visitor_id', $visitor->id)->where('building_id', $request->building_id)->first();
            if ($is_has_achievement) {
                return response()->json([
                    'message' => 'achievement all ready stored'
                ]);
            }
            $building = Building::find($request->building_id);
            if (!$building) {
                return response()->json([
                    'message' => 'building not found'
                ]);
            }
            $visitor->visits()->attach($building);
            return response()->json([
                'message' => 'achievement stored successfully'
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
    public function destroy(string $id)
    {
        //
    }
}
