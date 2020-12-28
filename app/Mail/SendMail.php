<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sub;
    public $mes;


    public function __construct($subject,$mail_text)
    {
        $this->sub=$subject;
        $this->mes=$mail_text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_subject= $this->sub;
        $e_message= $this->mes;
        return $this->view('maileclipse::templates.gggg',compact('e_message'))->subject($e_subject);
    }
}
