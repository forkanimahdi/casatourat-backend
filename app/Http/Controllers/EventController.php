<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use LDAP\Result;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        return view("Event.events", compact('events'));
    }

    public function show(Request $request, Event $event)
    {
        return view("Event.partials.update_event", compact('event'));
    }

    public function post(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'image' => 'required'
        ]);


        if ($request->image) {
            $image = $request->file('image');
            $imageName = time() . $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'image' => $imageName,
        ]);

        return back();
    }


    public function update(Request $request, Event $event)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'image' => 'required'
        ]);

        if ($request->image) {
            $image = $request->file('image');
            $imageName = time() . $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'image' => $imageName,
        ]);

        return back();
    }

    public function destroy(Request $request, Event $event)
    {
        $event->delete();
        return back();
    }
}
