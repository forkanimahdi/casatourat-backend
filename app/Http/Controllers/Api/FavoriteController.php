<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FavoriteRequest;
use App\Http\Resources\BuildingResource;
use App\Models as models;
use App\TokenValidation;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    use TokenValidation;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) {
            return BuildingResource::collection($visitor->favorites);
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
                        'message' => "Building with id '$building_id' not found",
                    ], 404);
                }

                dd($building);
                $visitor->favorites()->attach($building);
            }
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $token)
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
    }
}
