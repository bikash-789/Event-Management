<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $event;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $event
     */
    public function __construct($user, $event)
    {
        $this->user = $user;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verify Your Booking')->view('emails.booking-verification')->with(['user' => $this->user,'event' => $this->event]);
    }
}
