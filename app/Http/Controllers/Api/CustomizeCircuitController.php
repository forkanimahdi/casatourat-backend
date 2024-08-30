<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Models\CustomizeCircuit;
use Illuminate\Http\Request;
use App\TokenValidation;
use App\Models as models;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\json;
// use function PHPSTORM_META\map;

class CustomizeCircuitController extends Controller
{
    use TokenValidation;
    public function index() {}

    public function store(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) use ($request) {
            $customizeCircuit =  CustomizeCircuit::create([
                'name' => $request->name,
                'visitor_id' => $visitor->id,
            ]);
            $customizeCircuit->buildings()->attach($request->buildings);
            return response()->json([
                "message" => "circuit stored successfully",
            ]);
        });
    }
    public function show(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) use ($request) {
            $customizeCircuits = CustomizeCircuit::where('visitor_id', $visitor->id)->get();
            return response()->json(
                $customizeCircuits->map(fn($customizeCircuit) => [
                    "id" => $customizeCircuit->id,
                    "name" => $customizeCircuit->name,
                    "buildings" => BuildingResource::collection($customizeCircuit->buildings),
                ]),
            );
        });
    }
    public function destroy(Request $request, string $customCircuit)
    {
        return $this->validateToken($request, function ($visitor) use ($customCircuit)  {
            
            $deletCircuit = CustomizeCircuit::where("id", $customCircuit)->first();
            $deletCircuit->delete();
            return response()->json([
                "message" => "circuit deleted succefully",
            ]);
        });
    }
}
