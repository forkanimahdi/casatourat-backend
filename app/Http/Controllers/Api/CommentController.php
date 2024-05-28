<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TokenValidation;
use App\Models as models;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    use TokenValidation;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $building_id)
    {
        return $this->validateToken($request, function ($visitor) use ($building_id, $request) {
            $building = models\Building::find($building_id);
            if (!$building) {
                return response()->json([
                    'message' => "building with id '$building_id' not found"
                ]);
            }
            return [
                'comments' => $building->comments->map(fn ($building) => [
                    'id' => $building->pivot->id,
                    'content' => $building->pivot->content,
                    'owner' => [
                        'first_name' => $building->first_name,
                        'last_name' => $building->last_name,
                    ]
                ]),
            ];
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) use ($request) {
            $building = models\Building::find($request->building_id);
            if (!$building) {
                return response()->json([
                    'message' => "building with id '$request->building_id' not found"
                ]);
            }
            $visitor->comments()->attach($building, [
                'content' => $request->content,
                'status' => $request->content,
            ]);
            return response()->json([
                'message' => 'comment stored successfully',
            ]);
        });
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
    public function update(Request $request, string $comment_id)
    {
        return $this->validateToken($request, function ($visitor) use ($request, $comment_id) {
            $comment = Comment::where('id', $comment_id)->first();
            if (!$comment) return;
            if ($visitor->id != $comment->visitor_id) return;
            $comment->update([
                'content' => $request->content,
            ]);
            $comment->save();
            return response()->json([
                'message' => 'comment updated successfully',
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $comment_id)
    {
        return $this->validateToken($request, function ($visitor) use ($comment_id) {
            $comment = Comment::where('id', $comment_id)->first();
            if (!$comment) return;
            if ($visitor->id != $comment->visitor_id) return;
            $comment->delete();
            return response()->json([
                'message' => 'comment deleted successfully',
            ]);
        });
    }
};
