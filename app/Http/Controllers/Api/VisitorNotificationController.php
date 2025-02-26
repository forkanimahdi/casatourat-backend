<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisitorNotificationResource;
use Illuminate\Http\Request;
use App\Models as models;
use App\Models\VisitorNotification;
use App\TokenValidation;

class VisitorNotificationController extends Controller
{
    use TokenValidation;

    public function show(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) {
            $notifs = VisitorNotification::where('visitor_id', $visitor->id)
            ->orWhereNull('visitor_id')
            ->latest()->get();
            return VisitorNotificationResource::collection($notifs);
        });
    }
}
