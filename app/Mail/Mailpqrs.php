<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailpqrs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance. 
     */
    public $cor;
    public $phot;
    public $ent;
    public $rad;
    public $res;
    public $fecres;
    public $fecrad;
    public $dias;
    public $pet;
    public $ofic;
    public $obs;
    public function __construct($correo,$photoreg,$respo,$radicado,$noment,$fecresp,$nompet,$diaspen,$fecsol,$ofic_act,$obs_asig)
    {
        $this->cor=$correo; // se recibe el nombre del afiliado en otra variable.
        $this->phot=$photoreg;
        $this->res=$respo;
        $this->rad=$radicado;
        $this->ent=$noment;
        $this->fecres=$fecresp;
        $this->pet=$nompet;
        $this->dias=$diaspen;
        $this->fecrad=$fecsol;
        $this->ofic=$ofic_act;
        $this->obs= $obs_asig;
    
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SIGSMU-PQRS',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.notificar.emailspqrs',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [$this->phot]; // se envia el archivo adjunto
    }
}
