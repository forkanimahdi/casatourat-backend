<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $reviews = Comment::all();
        return view('notifications.notif', compact('reviews'));
    }

    public function show(Comment $review)
    {
        return view('notifications.eachnotif', compact('review'));
    }

    public function destroy(Comment $review)
    {
        $review->delete();
        return back();
    }

    public function store(Request $request)
    {
        Comment::create([
            'visitor_id' => $request->visitor_id,
            'circuit_id' => $request->circuit_id,
            'content' => $request->content,
            'status' => $request->status,
        ]);
        return back();
    }

    public function update(Request $request, Comment $review)
    {
        $response = !$review->mark_read;
        // dd($review);
        $review->update([
            'mark_read' => $response,
        ]);
        return back();
    }

    public function asread()
    {
        $reviews = Comment::where('mark_read', false)->get();
        foreach ($reviews as $review) {
            $review->update([
                'mark_read' => !$review->mark_read,
            ]);
        }
        return back();
    }
}
