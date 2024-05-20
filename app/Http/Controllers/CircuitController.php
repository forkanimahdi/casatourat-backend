<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Circuit;
use App\Models\Path;
use Illuminate\Http\Request;

class CircuitController extends Controller
{
    public function index()
    {
        return view('circuit.welcome');
    }

    public function post(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'alternative' => 'required',
            'description' => 'required',
            'audio' => 'required',
            'image' => 'required',
            'headpoint' => 'required',
            'zoom' => 'required',
        ]);

        $circuit = Circuit::create([
            'name' => $request->name,
            'alternative' => $request->alternative,
            'description' => $request->description,
            'description' => $request->description,
            'audio' => $request->audio,
            'headpoint' => $request->headpoint,
            'zoom' => $request->zoom,
        ]);

        $images = $request->file('image');
        foreach ($images as  $image) {
            $imageName = time() . $image->getClientOriginalName();
            $circuit->images()->create([
                'path' => $imageName
            ]);
            $image->storeAs('circuits/', $imageName, 'public');
        }

        return redirect()->route('circuit.index', compact('circuit'));
    }

    public function path_post(Request $request)
    {
        // ! method 1
        // $validator = Validator::make($request->json()->all(), [
        //     '*.circuit_id' => 'nullable|integer', // Adjust validation as needed
        //     '*.latitude' => 'required|numeric|between:-90,90',
        //     '*.longitude' => 'required|numeric|between:-180,180',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors() . 'hahahahhahah', 422);
        // }

        // ! method 2
        $request->validate([
            '*.circuit_id' => 'required',
            '*.latitude' => 'required|numeric|between:-90,90',
            '*.longitude' => 'required|numeric|between:-180,180',
        ]);


        $circuit = $request->json()->all();
        foreach ($circuit as $path) {
            Path::create([
                'circuit_id' => $path['circuit_id'],
                'latitude' => $path['latitude'],
                'longitude' => $path['longitude'],
            ]);
        }

        return response()->json(['route_to_building' => '/assign_building/map/' . $circuit[0]['circuit_id']]);
    }


    public function assign_building(Building $buildign, Request $request)
    {
        $buildign->update([
            'circuit_id' => $request->circuit_id,
        ]);
        return back();
    }

    public function unassign_building(Request $request)
    {

        $building_id = $request->building_id;
        $building = Building::where('id', $building_id)->first();
        $building['circuit_id'] = null;
        $building->save();
        return back();
    }


    public function circuit_map_index(Circuit $circuit)
    {
        return view('circuit.circuit_map', compact('circuit'));
    }


    public function assign_building_index(string $id)
    {
        $path_of_circuit = Path::select('latitude AS lat', 'longitude AS lng')->where('circuit_id', $id)->get();
        $buildings = Building::all()->where('circuit_id', null);
        $circuit = Circuit::where('id', $id)->first();
        return view('circuit.assign_building_map', compact('path_of_circuit', 'buildings', 'id', 'circuit'));
    }
}
