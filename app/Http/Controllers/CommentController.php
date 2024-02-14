<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->post_id = $postId;
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }

    public function destroy(Request $request, Comment $comment)
    {
        // Check if the authenticated user is authorized to delete the comment
        if ($request->user()->can('delete', $comment)) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully.');
        }

        return back()->with('error', 'Unauthorized to delete comment.');
    }

    public function update(Request $request, Comment $comment)
    {
        // Check if the authenticated user is authorized to update the comment
        if ($request->user()->can('update', $comment)) {
            $request->validate([
                'content' => 'required|string|max:255',
            ]);

            $comment->update(['content' => $request->content]);

            return back()->with('success', 'Comment updated successfully.');
        }

        return back()->with('error', 'Unauthorized to update comment.');
    }
}
