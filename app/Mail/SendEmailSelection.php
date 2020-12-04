<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailSelection extends Mailable
{
    use Queueable, SerializesModels;

    protected $donnee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($donnee)
    {
        $this->donnee = $donnee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('sendEmailSelection')->subject('Projet Formation 5000 jeunes')->with([
                        'nom' => $this->donnee['nom'],
                    ]);
    }
}
