<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function building_map_index()
    {
        $buildings = Building::where('circuit_id', null)->get();

        return view('circuit.building_map', compact('buildings'));
    }


    public function buildign_post(Request $request)
    {
        request()->validate([
            'circuit_id' => 'nullable',
            'name' => 'required',
            'description' => 'required',
            'audio' => 'required',
            'image' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $building =  Building::create([
            'circuit_id' => $request->circuit_id,
            'name' => $request->name,
            'description' => $request->description,
            'audio' => $request->audio,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $images = $request->file('image');
        foreach ($images as  $image) {
            $imageName = time() .  $image->getClientOriginalName();
            $building->images()->create([
                'path' => $imageName
            ]);
            $image->storeAs('buildings/', $imageName, 'public');
        }
        return back();
    }

    public function delete_building(Request $request)
    {
        $building_id = $request->building_id;
        $building = Building::where('id', $building_id)->first();
        $building->delete();
        return back();
    }
}
