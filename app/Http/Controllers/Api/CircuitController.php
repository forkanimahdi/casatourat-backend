<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CircuitResource;
use App\Models\Circuit;
use App\TokenValidation;
use Illuminate\Http\Request;

class CircuitController extends Controller
{
    use TokenValidation;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->validateToken($request, function ($visitor) {
            $circuits = $visitor->role == 'admin' ? Circuit::all() : Circuit::where('published', 1)->get();
            return CircuitResource::collection($circuits);
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
