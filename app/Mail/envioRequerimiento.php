<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class envioRequerimiento extends Mailable
{
    use Queueable, SerializesModels;

    public $consecutivo, $tipo_requerimiento;

    public $subject = "Solicitud de revisión de requerimiento - Estrategia Contributo";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($consecutivo, $tipo_requerimiento)
    {
        $this->consecutivo = $consecutivo;
        $this->tipo_requerimiento = $tipo_requerimiento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.envio_requerimiento')->with($this->consecutivo, $this->tipo_requerimiento);
    }
}
