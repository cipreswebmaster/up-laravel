<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ColegioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $pass;
    public $email;  

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $pass, string $email)
    {
      $this->name = $name;
      $this->pass = $pass;
      $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Bienvenido a UP")
                    ->view('templates.colegio');
    }
}
