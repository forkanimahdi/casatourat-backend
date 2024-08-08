<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\CircuitResource;
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
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $item_id)
    {
        return $this->validateToken(
            $request,
            function (models\Visitor $visitor) use ($item_id) {

                // find route name
                $routeName = request()->route()->getName();


                // find model
                if (strpos($routeName, 'building') !== false) {
                    $model = models\Building::class;
                    $modelName = 'Building';
                } elseif (strpos($routeName, 'circuit') !== false) {
                    $model = models\Circuit::class;
                    $modelName = 'Circuit';
                } else {
                    return response()->json([
                        'message' => 'Invalid route',
                    ], 400);
                }


                // find instance
                $item = $model::find($item_id);


                if (!$item) {
                    return response()->json([
                        'message' => "$modelName with id '$item_id' not found",
                    ], 404);
                }

                // attach the instance to the visitor's favorites
                if ($modelName == 'Building') {
                    $visitor->favorite_building()->attach($item);
                } else {
                    $visitor->favorite_circuit()->attach($item);
                }



                return response()->json([
                    'message' => "$modelName added to favorites successfully!!",
                    $modelName . '_id' => $item_id,
                ], 200);
            }
        );
    }

    /**
     * Display the specified resource.we
     */
    public function show(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) {
            return response()->json([
                'favorite_buildings' => BuildingResource::collection($visitor->favorite_building),
                'favorite_circuits' => CircuitResource::collection($visitor->favorite_circuit),
            ]);
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
    public function destroy(Request $request, string $item_id)
    {
        return $this->validateToken(
            $request,
            function (models\Visitor $visitor) use ($item_id) {
                //* Mostly same as the store function

                // get route name
                $routeName = request()->route()->getName();


                // find model
                if (strpos($routeName, 'building') !== false) {
                    $table = 'favorite_building';
                    $chosen_id = 'building_id';
                } elseif (strpos($routeName, 'circuit') !== false) {
                    $table = 'favorite_circuit';
                    $chosen_id = 'circuit_id';
                } else {
                    return response()->json([
                        'message' => 'Invalid route',
                    ], 400);
                }

                // find visitor's favorites
                $favorites = DB::table($table)->where("visitor_id", $visitor->id);

                if (!$favorites->first()) {
                    return response()->json([
                        'message' => "Visitor hasn't Favorited",
                    ], 404);
                }

                // find the building or circuit
                $favorite = $favorites->where($chosen_id, $item_id)->first();
                // and delete it
                DB::table($table)->delete($favorite->id);

                return response()->json([
                    'message' => "Unfavorite '$item_id' Successfully!!",
                ], 200);
            }
        );
    }
}
