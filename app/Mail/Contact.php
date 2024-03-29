<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class Contact extends Mailable
{
    use Queueable, SerializesModels;
protected $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Contact $contact)
    {
        $this->contact=$contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact.admin')->subject('Contact Request')->with(['contact'=> $this->contact]);
    }
}
