<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Image;
use Illuminate\Http\Request;
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
        request()->validate([
            'circuit_id' => 'nullable|integer',
            'name' => 'required|array|min:3',
            'name.en' => 'required|string',
            'name.fr' => 'required|string',
            'name.ar' => 'required|string',
            'description' => 'required|array|min:3',
            'description.en' => 'required|string',
            'description.fr' => 'required|string',
            'description.ar' => 'required|string',
            'audio' => 'required|array|min:3',
            'audio.en' => 'required|mimes:mp3,wav',
            'audio.fr' => 'required|mimes:mp3,wav',
            'audio.ar' => 'required|mimes:mp3,wav',
            'image.*' => 'required|mimes:png,jpg,jfif',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $audioFiles = [];
        foreach (['en', 'fr', 'ar'] as $lang) {
            if ($request->hasFile("audio.$lang")) {
                $audioFile = $request->file("audio.$lang");
                $audioName = time() . "_" . $lang;
                $audioPath = $audioFile->storeAs('audios', $audioName, 'public');
                $audioFiles[$lang] = $audioPath;
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
        foreach ($images as  $image) {
            $imageName = time() .  $image->getClientOriginalName();
            $building->images()->create([
                'path' => $imageName
            ]);
            $image->storeAs('images', $imageName, 'public');
        }

        return redirect()->route('building.index');
    }

    public function edit(Building $building)
    {
        return view('building.buildings_show', compact('building'));
    }

    public function update(Request $request, Building $building)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $building->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->file('audio')) {
            Storage::disk('public')->delete('audios/' . $building->audio);
            $audio = $request->file('audio');
            $audioName = time() . $audio->getClientOriginalName();
            $building->audio = $audioName;
            $building->save();
            $audio->storeAs('audios', $audioName, 'public');
        }

        $images = $request->file('image');
        if ($images) {
            foreach ($images as $image) {
                $imageName = time() . $image->getClientOriginalName();
                $building->images()->create([
                    'path' => $imageName
                ]);
                $image->storeAs('images', $imageName, 'public');
            }
        }

        return back();
    }

    public function store_image(Request $request, Building $building)
    {
        request()->validate([
            'image.*' => 'required|mimes:png,jpg',
        ]);
        $images = $request->file('image');
        if ($images) {
            foreach ($images as $image) {
                $imageName = time() . $image->getClientOriginalName();
                $building->images()->create([
                    'path' => $imageName
                ]);
                $image->storeAs('images', $imageName, 'public');
            }
        }

        return back();
    }

    public function update_image(Request $request, Image $image)
    {
        request()->validate([
            'image' => 'required'
        ]);

        Storage::disk('public')->delete('images/' . $image->path);
        $fileImage = $request->file('image');
        $imageName = time() . $fileImage->getClientOriginalName();
        $fileImage->storeAs('images', $imageName, 'public');

        $image->update([
            'path' => $imageName,
        ]);

        return back();
    }

    public function destory_image(Image $image)
    {
        Storage::disk('public')->delete('images/' . $image->path);
        $image->delete();
        return back();
    }

    public function destroy(Building $building)
    {
        // delete the images
        foreach ($building->images as $image) {
            $this->destory_image($image);
        }

        // delete the audio
        Storage::disk('public')->delete('audios/' . $building->audio);


        $building->delete();
        return redirect()->route('building.index');
    }
}
