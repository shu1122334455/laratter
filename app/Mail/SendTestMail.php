<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTestMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;      //追加

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)      //引数を追加
    {
        $this->data = $data;      //追加
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //以下を追加
        return $this->view('mail.contact')
            ->subject('メッセージを受け付けました')
            ->from('sample@sample.com', 'テストメール事務局')
            ->subject('テストメールです。')
            ->with('data', $this->data);
    }
}
