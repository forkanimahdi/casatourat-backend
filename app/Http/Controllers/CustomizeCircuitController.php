<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\CustomizeCircuit;
use Illuminate\Http\Request;

class CustomizeCircuitController extends Controller
{
    //
    public function index () {
        $buildings = Building::all();
        $customizeCircuits = CustomizeCircuit::all();
        return view('circuit.customize_circuite', compact('buildings','customizeCircuits'));
    }
    public function store (Request $request) {
        // dd($request);
        $customizeCircuit =  CustomizeCircuit::create([
            'name' => $request->name,
            'visitor_id' => $request->visitor_id,
        ]);
        $customizeCircuit->buildings()->attach($request->buildings);
        return back();
    }
}
