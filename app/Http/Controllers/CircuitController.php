<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Circuit;
use App\Models\Path;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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
        // $data = $request->json()->all();
        // if ($request->hasFile('audio')) {
        //     return [
        //         'aud' => $request->file('audio')->getClientOriginalName(),
        //         'des' => $request->description,
        //         'cord' => $request->get('cordinates')
        //     ];
        // }
        // return 'noooo';

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

        $paths = json_decode($request->get('cordinates'), true);
        foreach ($paths as $path) {
            Path::create([
                'circuit_id' => $circuit->id,
                'latitude' => $path['latitude'],
                'longitude' => $path['longitude'],
            ]);
        }

        return response()->json(['route_to_building' => '/circuit/assign_building/map/' . $circuit->id]);
    }

    public function show(Circuit $circuit)
    {
        return view('circuit.circuit_show', compact('circuit'));
    }

    public function assign_building_index(string $id)
    {
        $path_of_circuit = Path::select('latitude AS lat', 'longitude AS lng')->where('circuit_id', $id)->get();
        $buildings = Building::where('circuit_id', null)->latest()->get();
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
                "appId" => 21462,
                "appToken" => "iIpwyGVqc27BSuZOCRmH8r",
                "title" => "casa guide",
                "body" => "a new circuit has been created",
                "dateSent" => "5-20-2024 9:43AM",
            ]);
        }
        return back();
    }

    public function update_map(Circuit $circuit)
    {

        return view('circuit.circuit_update_map', compact('circuit'));
    }

    public function update(Request $request, string $id)
    {
        // if ($request->hasFile('name')) {
        //     return [
        //         'name' => $request->name,
        //         'des' => $request->description,
        //         'cord' => $request->get('cordinates')
        //     ];
        // }
        // return 'noooo' . $request->name . 'hahah';

        request()->validate([
            'name' => 'required',
            'alternative' => 'required',
            'description' => 'required',
        ]);

        $circuit = Circuit::where('id', $id)->first();

        if ($request->file('audio')) {
            Storage::disk('public')->delete('audios/' . $circuit->audio);
            $audio = $request->file('audio');
            $audioName = time() . $audio->getClientOriginalName();
            $circuit->audio = $audioName;
            $circuit->save();
            $audio->storeAs('/audios', $audioName, 'public');
        }

        $circuit->update([
            'name' => $request->name,
            'alternative' => $request->alternative,
            'description' => $request->description,
        ]);


        $circuitPaths = Path::where('circuit_id', $id)->get();
        foreach ($circuitPaths as $path) {
            $path->delete();
        }

        $new_paths = json_decode($request->get('cordinates'), true);
        foreach ($new_paths as $path) {
            Path::create([
                'circuit_id' => $path['circuit_id'],
                'latitude' => $path['latitude'],
                'longitude' => $path['longitude'],
            ]);
        }

        return response()->json([
            'message' => 'circuit updated successfully'
        ]);
    }

    public function destroy(Circuit $circuit)
    {
        foreach ($circuit->buildings as $building) {
            $building->update([
                'circuit_id' => null
            ]);
        }
        $circuit->delete();
        return redirect()->route('dashboard');
    }
}
