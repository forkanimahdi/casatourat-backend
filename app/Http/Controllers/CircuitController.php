<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Circuit;
use App\Models\Image;
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

    public function store(Request $request)
    {

        request()->validate([
            'coordinates' => 'required|json',
            'name' => 'required|array|min:3',
            'name.en' => 'required|string',
            'name.fr' => 'required|string',
            'name.ar' => 'required|string',
            'description' => 'array|min:3',
            'description.en' => 'string|nullable',
            'description.fr' => 'string|nullable',
            'description.ar' => 'string|nullable',
            'audio' => 'array|min:3',
            'audio.en' => 'mimes:mp3,wav',
            'audio.fr' => 'mimes:mp3,wav',
            'audio.ar' => 'mimes:mp3,wav',
            'image.*' => 'mimes:png,jpg,jpeg',
        ]);

        $audioFiles = [];
        foreach (['en', 'fr', 'ar'] as $lang) {
            if ($request->hasFile("audio.$lang")) {
                $audioFile = $request->file("audio.$lang");
                $audioName = time() . "_" . $lang . "." . $audioFile->extension();
                $audioFile->storeAs('audios', $audioName, 'public');
                $audioFiles[$lang] = $audioName;
            }
        }

        $circuit = Circuit::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'audio' => $audioFiles,
        ]);

        $images = $request->file('image');
        Image::store($circuit, $images);

        $paths = json_decode($request->coordinates, false);

        foreach ($paths as $path) {
            Path::create([
                'circuit_id' => $circuit->id,
                'latitude' => $path->latitude,
                'longitude' => $path->longitude,
            ]);
        }

        return redirect(route('circuits.show', $circuit));
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
        try {
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
        } catch (\Throwable $e) {
            dump('error', $e);
            return abort(404, 'something went wrong');
        }
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
