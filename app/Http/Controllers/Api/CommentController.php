<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\VisitorResource;
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
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->validateToken($request, function (models\Visitor $visitor) use ($request) {
            $circuit = models\Circuit::find($request->circuit_id);
            if (!$circuit) {
                return response()->json([
                    'message' => "Circuit with id '$request->circuit_id' not found"
                ]);
            }
            $visitor->comments()->attach($circuit, [
                'content' => $request->content,
                'status' => $request->status,
            ]);
            return response()->json([
                'message' => 'comment stored successfully',
            ]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $circuit_id)
    {
        // return $this->validateToken($request, function ($visitor) use ($circuit_id, $request) {
        //     $circuit = models\Circuit::find($circuit_id);
        //     if (!$circuit) {
        //         return response()->json([
        //             'message' => "circuit with id '$circuit_id' not found"
        //         ]);
        //     }
        //     return [
        //         'comments' => $circuit->comments->map(fn ($circuit) => [
        //             'id' => $circuit->pivot->id,
        //             'content' => $circuit->pivot->content,
        //             'owner' => [
        //                 'first_name' => $circuit->first_name,
        //                 'last_name' => $circuit->last_name,
        //             ]
        //         ]),
        //     ];
        // });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $comment_id)
    {
        // return $this->validateToken($request, function ($visitor) use ($request, $comment_id) {
        //     $comment = Comment::where('id', $comment_id)->first();
        //     if (!$comment) return;
        //     if ($visitor->id != $comment->visitor_id) return;
        //     $comment->update([
        //         'content' => $request->content,
        //     ]);
        //     $comment->save();
        //     return response()->json([
        //         'message' => 'comment updated successfully',
        //     ]);
        // });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $comment_id)
    {
        // return $this->validateToken($request, function ($visitor) use ($comment_id) {
        //     $comment = Comment::where('id', $comment_id)->first();
        //     if (!$comment) return;
        //     if ($visitor->id != $comment->visitor_id) return;
        //     $comment->delete();
        //     return response()->json([
        //         'message' => 'comment deleted successfully',
        //     ]);
        // });
    }
};
