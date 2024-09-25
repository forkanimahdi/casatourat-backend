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
            'buildings' => 'array',
        ]);

        $audioFiles = [
            'en' => null,
            'fr' => null,
            'ar' => null,
        ];
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

        // add the circuit path
        $paths = json_decode($request->coordinates, false);
        foreach ($paths as $path) {
            Path::create([
                'circuit_id' => $circuit->id,
                'latitude' => $path->latitude,
                'longitude' => $path->longitude,
            ]);
        }

        // assign buildings to circuit
        foreach ($request->buildings as $building_id) {
            $building = Building::find($building_id);
            if ($building) {
                $building->update([
                    'circuit_id' => $circuit->id,
                ]);
            }
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

    public function update(Request $request, Circuit $circuit)
    {
        request()->validate([
            'name' => 'required|array|min:3',
            'name.en' => 'required|string',
            'name.fr' => 'required|string',
            'name.ar' => 'required|string',
            'description' => 'array|min:3',
            'description.en' => 'string|nullable',
            'description.fr' => 'string|nullable',
            'description.ar' => 'string|nullable',
            'audio' => 'array',
            'audio.en' => 'mimes:mp3,wav',
            'audio.fr' => 'mimes:mp3,wav',
            'audio.ar' => 'mimes:mp3,wav',
        ]);

        $audioFiles = (array)$circuit->audio;

        foreach (['en', 'fr', 'ar'] as $lang) {
            if ($request->hasFile("audio.$lang")) {
                Storage::disk('public')->delete('audios/' . $audioFiles[$lang]);
                $audioFile = $request->file("audio.$lang");
                $audioName = time() . "_" . $lang;
                $audioFile->storeAs('audios', $audioName, 'public');
                $audioFiles[$lang] = $audioName;
            }
        }

        $circuit->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'audio' => $audioFiles,
        ]);

        // $circuitPaths = Path::where('circuit_id', $id)->get();
        // foreach ($circuitPaths as $path) {
        //     $path->delete();
        // }

        // $new_paths = json_decode($request->get('cordinates'), true);
        // foreach ($new_paths as $path) {
        //     Path::create([
        //         'circuit_id' => $path['circuit_id'],
        //         'latitude' => $path['latitude'],
        //         'longitude' => $path['longitude'],
        //     ]);
        // }

        return back();
    }

    public function destroy(Circuit $circuit)
    {
        foreach ($circuit->buildings as $building) {
            $building->update([
                'circuit_id' => null
            ]);
        }

        // delete the images
        foreach ($circuit->images as $image) {
            $image->erase();
        }

        // delete the audios
        foreach ((array)$circuit->audio as $lang => $audioFile) {
            Storage::disk('public')->delete('audios/' . $audioFile);
        }

        $circuit->delete();

        return redirect()->route('circuits.index');
    }
}
