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
        $unassigned_buildings = Building::where('circuit_id', null)->get();
        $assigned_buildings = Building::where('circuit_id', '!=', null)->get();
        return view('building.building_index', compact('unassigned_buildings', 'assigned_buildings'));
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
            'image.*' => 'required|mimes:png,jpg',
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
        return back();
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

    public function destroy(string $id)
    {
        $building = Building::where('id', $id)->first();
        $building->delete();
        return back();
    }
}
