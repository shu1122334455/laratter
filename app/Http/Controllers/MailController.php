<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\TestMail;      //Mailableクラス
use Mail;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('send.index');
    }
    public function send(Request $request)
    {
        $rules = [
            'name' => 'required|',
            'message' => 'required'
        ];

        $messages = [
            'name.required' => '名前を入力してください。',
            'message.required' => 'メッセージを入力してください。'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/mail')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validate();

        Mail::to('leda75@example.com')->send(new TestMail($data));

        session()->flash('success', '送信しました！');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('send.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
