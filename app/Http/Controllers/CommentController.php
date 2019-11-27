<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'comment' => 'required',
        ]);

        auth()->user()->comment($post, $request->comment);

        return redirect($post->url);
    }

    public function accept(Comment $comment)
    {
        $this->authorize('accept', $comment);

        $comment->markAsAnswer();

        return redirect($comment->post->url);
    }
}
