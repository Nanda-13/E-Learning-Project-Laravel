<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    // Comment Create
    public function create(Request $request) {

        // dd($request->toArray());
        $request->validate(['message' => 'required']);

        Comment::create([
            'user_id' => $request->user_id ,
            'lesson_id' => $request->lesson_id ,
            'message' => $request->message
        ]);

        return back()->with('success', "Your Comment Success!");
    }

    // Comment Reply
    public function reply(Request $request, Comment $comment) {

        $request->validate(['message' => 'required']);

        Comment::create([
            'user_id' => $request->user_id ,
            'lesson_id' => $request->lesson_id ,
            'message' => $request->message ,
            'parent_id' => $comment->id ,
        ]);

        return back()->with('success', "Your Reply Comment Success!");
    }

    // Comment Update
    public function update(Request $request, Comment $comment)
    {
        // $this->authorize('update', $comment);

        $request->validate(['message' => 'required']);

        $comment->update(['message' => $request->message]);

        return back()->with('update', 'Comment updated successfully!');
    }

    // Comment Delete
    public function delete($id)
    {
        // $this->authorize('delete', $comment);

        Comment::find($id)->delete();

        return back()->with('delete', 'Comment deleted successfully!');
    }
}
