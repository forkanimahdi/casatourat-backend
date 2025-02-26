<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models as models;
use App\Models\GuidedVisit;
use App\Models\VisitorNotification;
use Carbon\Carbon;
use ExpoSDK\Expo;
use ExpoSDK\ExpoMessage;

class GuidedVisitController extends Controller
{
    public function index()
    {
        $guided = models\GuidedVisit::latest()->get();

        $visitors = models\Visitor::select('id', 'full_name', 'email')->get();
        $circuits = models\Circuit::select('id', 'name')->get();

        return view('guided.guided_index', compact('guided', 'visitors', 'circuits'));
    }

    public function clearance(Request $request, GuidedVisit $visit)
    {
        // action is approve or deny: whichever the admin pressed
        $action = $request->input('action');

        $updateValues = [
            'pending' => false,
            'approved' => $action === 'approve'
        ];

        // just to check that the admin pressed approve or deny: redundant but safe
        if ($action === 'approve' || $action === 'deny') {
            $visit->update($updateValues);
        }

        $res = $action === "approve" ? "approved" : "denied";

        $response = (object)[
            'en' => $res,
            'fr' => $res === "approved" ? "approuvé" : "refusé",
            'ar' => $res === "approved" ? "تم الموافقة" : "مرفوض"
        ];

        // todo check if date language is correct
        $formattedDateEnglish = Carbon::parse($visit->date)->locale('en')->format('l j F');
        $formattedDateFrench = Carbon::parse($visit->date)->locale('fr')->format('l j F');
        $formattedDateArabic = Carbon::parse($visit->date)->locale('ar')->format('l j F');

        $content = [
            'en' => 'Your request for The guided visit on ' . $formattedDateEnglish . ' has been ' . $res,
            'fr' => 'Votre demande pour la visite guidée du ' . $formattedDateFrench . ' a été ' . $response->fr,
            'ar' => 'طلبك لزيارة مرشدة في ' . $formattedDateArabic . ' تم ' . $response->ar,
        ];

        $responseJson = json_encode($response);
        $contentJson = json_encode($content);

        // Create a notification for the visitor to be displayed in the notification page
        VisitorNotification::create([
            'visitor_id' => $visit->visitor->id,
            'type' => 'guide',
            'title' => $responseJson,
            'content' => $contentJson,
        ]);

        $message = [
            new ExpoMessage([
                'title' => 'Guided Visit',
                'body' => 'Your Guided Visit Request has been ' . $res,
            ]),
        ];

        // check if the user has a token first
        if ($visit->visitor->expoToken) {
            (new Expo())->send($message)->to($visit->visitor->expoToken)->push();
        }


        return back()->with('success', $visit->visitor->full_name ."'s request has been " . $res . " successfully.");
    }
}
