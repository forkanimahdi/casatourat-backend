<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisitorNotificationResource;
use Illuminate\Http\Request;
use App\Models as models;
use App\TokenValidation;

class VisitorNotificationController extends Controller
{
    use TokenValidation;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) {
            return VisitorNotificationResource::collection($visitor->visitor_notifications);
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
