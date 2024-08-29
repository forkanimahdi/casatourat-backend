<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models as models;
use Illuminate\Http\Request;
use App\TokenValidation;

class VisitedBuildingsController extends Controller
{
    use TokenValidation;

    /**
     * Display a listing of the resource.w
     */
    public function show(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) {
            return response()->json(
                $visitor->visited_buildings->map(fn($building) => $building->id)
            );
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $building_id)
    {
        return $this->validateToken(
            $request,
            function (models\Visitor $visitor) use ($building_id) {
                $building = models\Building::find($building_id);

                if (!$building) {
                    return response()->json([
                        'message' => "building with id '$building_id' not found",
                    ], 404);
                }

                $visitor->visited_buildings()->attach($building);

                return response()->json([
                    'message' => "Building Has Been Visited Successfully!!",
                ], 200);
            }
        );
    }
}
