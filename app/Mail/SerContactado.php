<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SerContactado extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $telefono;
    public $correo;
    public $universidad;
    public $profesion;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($universidad, $nombre, $telefono, $correo, $profesion)
    {
      $this->universidad = $universidad;
      $this->nombre = $nombre;
      $this->telefono = $telefono;
      $this->correo = $correo;
      $this->profesion = $profesion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("MENSAJE DE CONTACTO DE UNIVERSIDAD")
                    ->view("templates.ser_contactado");
    }
}
