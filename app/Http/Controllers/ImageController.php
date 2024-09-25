<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Circuit;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        request()->validate([
            'id' => 'required|integer',
            'type' => 'required|in:circuit,building',
            'image.*' => 'required|mimes:png,jpg',
        ]);

        $ressource = null;

        switch ($request->type) {
            case 'building':
                $ressource = Building::find($request->id);
                break;
            case 'circuit':
                $ressource = Circuit::find($request->id);
                break;
        }

        if ($ressource) {
            $images = $request->file('image');
            Image::store($ressource, $images);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        Storage::disk('public')->delete('images/' . $image->path);
        $image->delete();
        return back();
    }
}
