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
    public $title;
    public $description;
    public $user_name;
    public $website;

    public function __construct($title, $description, $user_name, $website)
    {
        $this->title = $title;
        $this->description = $description;
        $this->user_name = $user_name;
        $this->website = $website;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email_template')->subject('A new post is added.');
    }
}
