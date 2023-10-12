<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tweet;

use App\Models\User;
use Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tweets = Tweet::getAllOrderByUpdated_at();
        return response()->view('tweet.index', compact('tweets'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('tweet.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'new_tweet' => 'required|max:255',
        ]);

        $tweet = new Tweet;
        $tweet->user_id = auth()->user()->id;
        $tweet->tweet = $validatedData['new_tweet'];
        $tweet->save();

        return redirect()->route('tweets.index');
    }






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tweet = Tweet::find($id);
        return response()->view('tweet.show', compact('tweet'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tweet = Tweet::find($id);
        return response()->view('tweet.edit', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tweet' => 'required|string|max:255',
        ]);
        $tweet = Tweet::find($id);
        $tweet->update([
            'tweet' => $request->input('tweet'),
        ]);
        $tweet = Tweet::findOrFail($id);

        $tweet->tweet = $request->input('tweet');
        $tweet->description = $request->input('description'); // 新しいフィールド

        $tweet->save();

        return redirect()->route('tweet.show', $tweet->id)->with('success', 'Tweet updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Tweet::find($id)->delete();
        return redirect()->route('tweet.index');
    }
    public function mydata()
    {
        // Userモデルに定義したリレーションを使用してデータを取得する．
        $tweets = User::query()
            ->find(Auth::user()->id)
            ->userTweets()
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->view('tweet.index', compact('tweets'));
    }
    public function timeline()
    {
        // フォローしているユーザを取得する
        $followings = User::find(Auth::id())->followings->pluck('id')->all();
        ($followings);
        // 自分とフォローしている人が投稿したツイートを取得する
        $tweets = Tweet::query()
            ->where('user_id', Auth::id())
            ->orWhereIn('user_id', $followings)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('tweet.index', compact('tweets'));
    }
}
