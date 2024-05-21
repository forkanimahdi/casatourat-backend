<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TokenValidation;
use Illuminate\Http\Request;
use App\Models as models;

class RateController extends Controller
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
        return $this->validateToken($request, function ($visitor) use ($request) {
            $building = models\Building::find($request->building_id);
            if (!$building) {
                return response()->json([
                    'message' => "building with id '$request->building_id' not found"
                ]);
            }
            $visitor->rates()->attach($building, [
                'value' => $request->value,
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
