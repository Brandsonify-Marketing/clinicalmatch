<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClinicalApplication extends Mailable
{
    use Queueable, SerializesModels;
    public $clinicaltrial;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clinicaltrial)
    {
        $this->clinicaltrial = $clinicaltrial;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.clinicalReview');
    }
}
