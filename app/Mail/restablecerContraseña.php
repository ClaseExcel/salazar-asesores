<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class restablecerContraseña extends Mailable
{
    use Queueable, SerializesModels;

    public $email, $password, $token;

    public $subject = "Notificación de creación de usuario - Estrategia Contributo";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password, $token)
    {
        $this->subject = $this->subject;
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.restablecer_contrasena')->with($this->email, $this->password, $this->token);
    }
}
