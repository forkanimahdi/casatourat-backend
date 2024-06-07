<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index () {
        $reviews = Comment::all();
        return view('notifications.notif', compact('reviews'));
    }
    public function show (Comment $review) {
        return view('notifications.eachnotif', compact('review'));
    }
    public function destroy (Comment $review) {
        $review->delete();
        return back();
    }
    public function store(Request $request) {
        Comment::create([
            'visitor_id'=> $request->visitor_id,
            'building_id'=>$request->building_id,
            'content' => $request->content,
            'status' => $request->status,
        ]);
        return back();
    }
    public function update(Request $request, Comment $review) {
        $response = !$review->mark_read;
        // dd($review);
        $review->update([
            'mark_read' => $response,
        ]);
        return back();
    }
    // public function search(Request $request) {
    //     $search = $request->input('filter');
    //     $results = Comment::where('status', $search)->get();
    //     return view()
    // }
}
