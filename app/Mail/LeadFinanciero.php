<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadFinanciero extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $correo;
    public $monto;
    public $uso;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $nombre, string $correo, string $monto, string $uso)
    {
      $this->nombre = $nombre;
      $this->correo = $correo;
      $this->monto = $monto;
      $this->uso = $uso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Lead servicios financieros | UP")
                    ->view('templates.financiero');
    }
}
