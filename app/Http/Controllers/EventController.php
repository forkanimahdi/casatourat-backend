<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LDAP\Result;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        return view("Event.events", compact('events'));
    }

    public function show(Request $request, Event $event)
    {
        return view("Event.partials.show_event", compact('event'));
    }

    public function edit(Request $request, Event $event)
    {
        return view('Event.partials.update_event', compact('event'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'image.*' => 'required|mimes:png,jpg'
        ]);

        $images = $request->file('image');
        if ($images) {

            $event = Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'start' => $request->start,
                'end' => $request->end,
                'latitude' => $request->event_lat,
                'longitude' => $request->event_long
            ]);

            foreach ($images as  $image) {
                $imageName = time() .  $image->getClientOriginalName();
                $event->images()->create([
                    'path' => $imageName
                ]);
                $image->storeAs('images', $imageName, 'public');
            }
        }

        return back();
    }


    public function update(Request $request, Event $event)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $images = $request->file('image');
        if ($images) {
            foreach ($images as $image) {
                $imageName = time() . $image->getClientOriginalName();
                $event->images()->create([
                    'path' => $imageName
                ]);
                $image->storeAs('images', $imageName, 'public');
            }
        }


        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return back();
    }

    public function destroy(Event $event)
    {
        // delete the bookings that has this event
        Booking::where('event_id', $event->id)->delete();

        // delete the images
        foreach ($event->images as $img) {
            Storage::disk('public')->delete('images/' . $img->path);
            $img->delete();
        }

        // delete the event itself
        $event->delete();
        return back();
    }


    public function destory_image(Event $event, Image $image)
    {
        if (count($event->images) > 1) {
            Storage::disk('public')->delete('images/' . $image->path);
            $image->delete();
        }
        return back();
    }
}
