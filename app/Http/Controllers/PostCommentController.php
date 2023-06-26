<?php

namespace App\Http\Controllers;

use App\Models\PostComments;
use App\Models\UserPost;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    //

    public function createComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'post_id' => 'required',
        ]);

        $commentData = [
            'comment' => strip_tags($request->comment),
            'post_id' => strip_tags($request->post_id),
            'user_id' => auth()->user()->id
        ];

        PostComments::create($commentData);

        return redirect(route('welcome'));
    }

    public function deleteComment($id)
    {
        $comment = PostComments::findOrFail($id);

        if ($comment->user_id == auth()->user()->id) {
            $comment->delete();
            return redirect(route('welcome'));
        }

        return redirect(route('welcome'));
    }
}
