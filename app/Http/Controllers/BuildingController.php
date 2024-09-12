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
            'circuit_id' => 'nullable',
            'name' => 'required',
            'description' => 'required',
            'audio' => 'required',
            'image.*' => 'required|mimes:png,jpg,jfif',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $audio = $request->file('audio');
        $audioName = time() . $audio->getClientOriginalName();
        $audio->storeAs('/audios', $audioName, 'public');

        $building =  Building::create([
            'circuit_id' => $request->circuit_id,
            'name' => $request->name,
            'description' => $request->description,
            'audio' => $audioName,
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

    public function store_image(Building $building, Request $request)
    {
        request()->validate([
            'image.*' => 'required|mimes:png,jpg',
        ]);

        $images = $request->file('image');
        foreach ($images as $image) {
            $imageName = time() . $image->getClientOriginalName();
            $building->images()->create([
                'path' => $imageName
            ]);
            $image->storeAs('images', $imageName, 'public');
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
