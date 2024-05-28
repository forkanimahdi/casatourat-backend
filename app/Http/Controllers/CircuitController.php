<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Circuit;
use App\Models\Path;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CircuitController extends Controller
{
    public function index()
    {
        $circuits = Circuit::all();
        return view('circuit.circuit_index', compact('circuits'));
    }

    public function create()
    {
        return view('circuit.circuit_create');
    }

    public function post(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'alternative' => 'required',
            'description' => 'required',
            'audio' => 'required',
        ]);

        $audio = $request->file('audio');
        $audioName = time() . $audio->getClientOriginalName();
        $audio->storeAs('/audios', $audioName, 'public');

        $circuit = Circuit::create([
            'name' => $request->name,
            'alternative' => $request->alternative,
            'description' => $request->description,
            'audio' => $audioName
        ]);

        return redirect()->route('circuit.map_index', compact('circuit'));
    }

    public function circuit_map_index(Circuit $circuit)
    {
        return view('circuit.circuit_map', compact('circuit'));
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
        return response()->json(['route_to_building' => '/circuit/assign_building/map/' . $circuit[0]['circuit_id']]);
    }

    public function assign_building_index(string $id)
    {
        $path_of_circuit = Path::select('latitude AS lat', 'longitude AS lng')->where('circuit_id', $id)->get();
        $buildings = Building::all()->where('circuit_id', null);
        $circuit = Circuit::where('id', $id)->first();
        return view('circuit.assign_building_map', compact('path_of_circuit', 'buildings', 'id', 'circuit'));
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

    public function update_draft(Circuit $circuit)
    {
        $currentValue = $circuit->published;
        $circuit->update([
            'published' => !$currentValue,
        ]);

        if ($circuit->published) {
            Http::post('https://app.nativenotify.com/api/notification', [
                "appId" => 21328,
                "appToken" => "TwOsi07V6IvVsAbrH9HDif",
                "title" => "casa guide",
                "body" => "a new circuit has been created",
                "dateSent" => "5-20-2024 9:43AM",
                "pushData" => ["yourProperty" => "yourPropertyValue"],
                "bigPictureURL" => "Big picture URL as a string"
            ]);
        }
        return back();
    }

    public function update_map(Circuit $circuit)
    {
        return view('circuit.circuit_update_map', compact('circuit'));
    }

    public function update_circuit(Request $request, string $id)
    {
        $circuitPaths = Path::where('circuit_id', $id)->get();

        foreach ($circuitPaths as $path) {
            $path->delete();
        }

        $circuit = $request->json()->all();
        foreach ($circuit as $path) {
            Path::create([
                'circuit_id' => $path['circuit_id'],
                'latitude' => $path['latitude'],
                'longitude' => $path['longitude'],
            ]);
        }

        return response()->json([
            'message' => 'success',
        ]);
    }

    public function update(Request $request, Circuit $circuit)
    {
        request()->validate([
            'name' => 'required',
            'alternative' => 'required',
            'description' => 'required',
        ]);

        if ($request->file('audio')) {
            Storage::delete('audios/' . $request->audio);
            $audio = $request->file('audio');
            $audioName = time() . $audio->getClientOriginalName();
            $audio->storeAs('/audios', $audioName, 'public');
        }

        $circuit->update([
            'name' => $request->name,
            'alternative' => $request->alternative,
            'description' => $request->description,
        ]);

        return back();
    }

    public function destroy(Circuit $circuit)
    {

        foreach ($circuit->buildings as $building) {
            $building->update([
                'circuit_id' => null
            ]);
        }

        $circuit->delete();
        return back();
    }
}
