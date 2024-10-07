<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Circuit;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    //
    public function store(Request $request)
    {

        request()->validate([
            'id' => 'required|integer',
            'type' => 'required|in:circuit,building',
            'video.*' => 'required|mimes:mp4,mov',
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
            $videos = $request->file('video');
            Video::store($ressource, $videos);
        }

        return back();
    }
    public function destroy(Video $video)
    {
        Storage::disk('public')->delete('videos/' . $video->path);
        $video->delete();
        return back();
    }
}
