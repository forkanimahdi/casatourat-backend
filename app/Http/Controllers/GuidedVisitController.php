<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models as models;
use App\Models\GuidedVisit;
use Carbon\Carbon;

class GuidedVisitController extends Controller
{
    public function index()
    {
        $guided = models\GuidedVisit::latest()->get();
        return view('guided.guided_index', compact('guided'));
    }

    public function clearance(Request $request, GuidedVisit $visit)
    {
        // action is approve or deny: whichever the user pressed
        $action = $request->input('action');

        $updateValues = [
            'pending' => false,
            'approved' => $action === 'approve'
        ];

        // just to check that the user pressed approve or deny: redundant but safe
        if ($action === 'approve' || $action === 'deny') {
            $visit->update($updateValues);
        }

        $res = $action === "approve" ? "approved" : "denied";

        // Create a notification for the visitor
        models\VisitorNotification::create([
            'visitor_id' => $visit->visitor->id,
            'type' => 'guide',
            'title' => $action,
            'content' => 'Your request for The guided visit on ' .  Carbon::parse($visit->date)->format('l j F') . ' has been ' . $res,
        ]);

        return back();
    }
}
