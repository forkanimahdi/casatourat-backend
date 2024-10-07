<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Image;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LDAP\Result;
use ExpoSDK\Expo;
use ExpoSDK\ExpoMessage;

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

    public function create()
    {
        return view("Event.partials.create_event");
    }

    public function edit(Request $request, Event $event)
    {
        return view('Event.partials.update_event', compact('event'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|array|min:3',
            'title.en' => 'required|string',
            'title.fr' => 'required|string',
            'title.ar' => 'required|string',
            'description' => 'required|array|min:3',
            'description.en' => 'required|string',
            'description.fr' => 'required|string',
            'description.ar' => 'required|string',
            'start' => 'required',
            'end' => 'required',
            'image.*' => 'required|mimes:png,jpg,jfif',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // TODO* ask if notification is needed when an event is added

        $images = $request->file('image');
        if ($images) {

            $event = Event::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start' => $request->start,
                'end' => $request->end,
                'latitude' => $request->latitude ?? null,
                'longitude' => $request->longitude ?? null,
            ]);

            foreach ($images as  $image) {
                $imageName = time() .  $image->getClientOriginalName();
                $event->images()->create([
                    'path' => $imageName
                ]);
                $image->storeAs('images', $imageName, 'public');
            }
        }

        if($event) {
            $message = [
                new ExpoMessage([
                    'title' => 'new event added',
                    'body' => $event->title->en,
                ]),
            ];

            $expo = Expo::driver('file');
            $expo->send($message)->toChannel('default')->push();
        }

        return redirect('/events');
    }


    public function update(Request $request, Event $event)
    {
        request()->validate([
            'title' => 'required|array|min:3',
            'title.en' => 'required|string',
            'title.fr' => 'required|string',
            'title.ar' => 'required|string',
            'description' => 'required|array|min:3',
            'description.en' => 'required|string',
            'description.fr' => 'required|string',
            'description.ar' => 'required|string',
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
            'title' => $request->input('title'),
            'description' => $request->input('description'),
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




    public function store_image(Request $request, Event $event)
    {
        request()->validate([
            'image.*' => 'required|mimes:png,jpg',
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



    public function sendNotif()
    {
        //! rwina o lbalbala
        //* Sending a message to one or more manually
        // $vis = Visitor::find(8);

        $message = [
            new ExpoMessage([
                'title' => 'Notification for default recipients',
                'body' => 'Because "to" property is not defined',
            ]),
        ];

        // $defaultRecipients = [
        //     'ExponentPushToken[BJYa2QJeurTh-v5oPcC8VF]',
        //     'ExponentPushToken[Z3lm68FTVhXlfGtcsdM4uk]'
        // ];


        // (new Expo)->send($message)->to($defaultRecipients)->push();

        //* Subscribing someone to a channel then sending a message to the channel
        $expo = Expo::driver('file');

        $channel = 'default';
        // $expo->subscribe($channel, $defaultRecipients);
        $expo->send($message)->toChannel($channel)->push();



        return back();
    }
}
