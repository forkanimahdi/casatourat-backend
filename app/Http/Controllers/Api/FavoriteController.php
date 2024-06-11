<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Models as models;
use App\TokenValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

                $visitor->favorites()->attach($building);
            }
        );
    }

    /**
     * Display the specified resource.we
     */
    public function show(string $token, )
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
    public function destroy(Request $request, string $building_id)
    {
        return $this->validateToken(
            $request,
            function (models\Visitor $visitor) use ($building_id) {
                $favorites = DB::table('favorites')->where("visitor_id", $visitor->id);

                if (!$favorites->first()) {
                    return response()->json([
                        'message' => "Visitor hasn't Favorties",
                    ], 404);
                }

                $favorite = $favorites->where("building_id", $building_id)->first();

                if (!$favorite) {
                    return response()->json([
                        'message' => "No such Building '$building_id' as Favorite",
                    ], 404);
                }

                DB::table('favorites')->delete($favorite->id);

                return response()->json([
                    'message' => "Unfavorite Building '$building_id' Successfully",
                ], 200);
            }
        );
    }
}
