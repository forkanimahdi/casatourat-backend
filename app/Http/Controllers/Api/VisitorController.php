<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VisitorRequest;
use App\Http\Resources\VisitorResource;
use App\Models\Visitor;
use App\TokenValidation;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    use TokenValidation;

    /**
     * Display a listing of the resource.w
     */
    public function index()
    {
        return VisitorResource::collection(Visitor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitorRequest $request)
    {
        Visitor::create(array_filter(
            $request->all(),
            fn ($key) => in_array($key, [
                "full_name",
                "email",
                "token",
                "gender",
                "birthday",
                "avatar"
            ]),
            ARRAY_FILTER_USE_KEY,
        ));

        return response()->json([
            'message' => "Vistor successfully created.",
            'data' => new VisitorResource(Visitor::where("token", $request->token)->first()),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $this->validateToken($request, function (Visitor $visitor) {
            return new VisitorResource($visitor);
        });
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
                    "full_name",
                    "gender",
                    "birthday",
                    "avatar"
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
                'message' => "Vistor successfully updated.",
                'data' => new VisitorResource($visitor),
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
