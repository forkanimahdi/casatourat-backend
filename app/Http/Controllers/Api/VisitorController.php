<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VisitorRequest;
use App\Models\Visitor;
use App\TokenValidation;
use Illuminate\Http\Request;

class VisitorController extends Controller
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
    public function store(VisitorRequest $request)
    {
        Visitor::create(array_filter(
            $request->all(),
            fn ($key) => in_array($key, [
                "first_name",
                "last_name",
                "email",
                "token",
                "gender",
            ]),
            ARRAY_FILTER_USE_KEY,
        ));

        return response()->json([
            'message' => "Vistor successfully created."
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->validateToken($request, function (Visitor $visitor) use ($request) {
            $data = array_filter(
                $request->all(),
                fn ($key) => in_array($key, [
                    "first_name",
                    "last_name",
                    "email",
                    "token",
                    "gender",
                ]),
                ARRAY_FILTER_USE_KEY,
            );

            if (!$data) {
                return response()->json([
                    'message' => "Cannot found any Matching Field."
                ], 400);
            }

            $visitor->update($data);

            return response()->json([
                'message' => "Vistor successfully updated."
            ], 200);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
