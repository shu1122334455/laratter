<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $tweetId)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        Comment::create([
            'text' => $request->input('text'),
            'user_id' => auth()->id(),
            'tweet_id' => $tweetId,
        ]);

        return redirect()->back();
    }
}
