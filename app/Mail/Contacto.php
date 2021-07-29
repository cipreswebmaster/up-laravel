<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contacto extends Mailable
{
    use Queueable, SerializesModels;

    public $names;
    public $school;
    public $email;
    public $phone;
    public $user_message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $names, string $school, string $email, string $phone, string $message)
    {
      $this->names = $names;
      $this->school = $school;
      $this->email = $email;
      $this->phone = $phone;
      $this->user_message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Mensaje de contacto UP")
                    ->view('templates.contacto');
    }
}
