<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(), ['body' => 'required|min:2']);
        $user_id = auth()->user()->id;

        $post->addComment(request('body'), $user_id);

        return back();
    }
}
