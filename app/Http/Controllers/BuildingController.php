<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Circuit;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::latest()->get();
        return view('building.building_index', compact('buildings'));
    }

    public function show(Building $building)
    {
        return view('building.buildings_show', compact('building'));
    }

    public function create()
    {
        $buildings = Building::where('circuit_id', null)->get();
        return view('building.building_map', compact('buildings'));
    }

    public function store(Request $request)
    {
        // dd($request);
        request()->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'name' => 'required|array|min:3',
            'name.en' => 'required|string',
            'name.fr' => 'required|string',
            'name.ar' => 'required|string',
            'description' => 'array|min:3',
            'circuit_id' => 'nullable|integer',
            'description.en' => 'nullable|string',
            'description.fr' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'audio' => 'array|min:3',
            'audio.en' => 'mimes:mp3,wav,m4a',
            'audio.fr' => 'mimes:mp3,wav,m4a',
            'audio.ar' => 'mimes:mp3,wav,m4a',
            'image.*' => 'mimes:png,jpg,jfif',

        ]);

        $audioFiles = [
            "en" => null,
            "fr" => null,
            "ar" => null,
        ];
        foreach (['en', 'fr', 'ar'] as $lang) {
            if ($request->hasFile("audio.$lang")) {
                $audioFile = $request->file("audio.$lang");
                $audioName = time() . "_" . $lang . "." . $audioFile->extension();
                $audioFile->storeAs('audios', $audioName, 'public');
                $audioFiles[$lang] = $audioName;
            }
        }

        $building =  Building::create([
            'circuit_id' => $request->circuit_id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'audio' => $audioFiles,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $images = $request->file('image');
        Image::store($building, $images);
        if ($building instanceof Model) {
            return redirect()->route('buildings.index')->with("success", "Building was created succefully.");
        } else {
            return redirect()->route('buildings.create')->with('error', 'Your building was not created.');
        }
    }

    public function edit(Building $building)
    {
        return view('building.buildings_show', compact('building'));
    }

    public function update(Request $request, Building $building)
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
            'audio.en' => 'mimes:mp3,wav,m4a',
            'audio.fr' => 'mimes:mp3,wav,m4a',
            'audio.ar' => 'mimes:mp3,wav,m4a',
        ]);

        $audioFiles = (array)$building->audio;
        foreach (['en', 'fr', 'ar'] as $lang) {
            if ($request->hasFile("audio.$lang")) {
                Storage::disk('public')->delete('audios/' . $audioFiles[$lang]);
                $audioFile = $request->file("audio.$lang");
                $audioName = time() . "_" . $lang . $audioFile->extension();
                $audioFile->storeAs('audios', $audioName, 'public');
                $audioFiles[$lang] = $audioName;
            }
        }

        $building->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'audio' => $audioFiles,
        ]);

        return back();
    }

    public function destroy(Building $building)
    {
        // delete the images
        foreach ($building->images as $image) {
            $image->erase();
        }

        // delete the audios
        foreach ((array)$building->audio as $lang => $audioFile) {
            Storage::disk('public')->delete('audios/' . $audioFile);
        }

        $building->delete();

        return redirect()->route('buildings.index');
    }

    public function assign(Request $request, Building $building)
    {
        $circuit = Circuit::where('id', $request->circuit_id)->first();
        $circuit->buildings()->attach($building);
        return back();
    }

    public function unassign(Request $request, Building $building)
    {
        // delete relation row
        DB::table('building_circuit')
            ->where('building_id', $building->id)
            ->where('circuit_id', $request->circuit_id)
            ->delete();
        return back();
    }
}
