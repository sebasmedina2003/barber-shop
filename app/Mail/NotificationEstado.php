<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationEstado extends Mailable
{
    use Queueable, SerializesModels;

    public $estado_cita;
    public $nombre_cliente;
    public $fecha_cita;



    /**
     * Create a new message instance.
     */
    public function __construct($estado, $nombre, $fecha)
    {
        $this->estado_cita = $estado;
        $this->nombre_cliente = $nombre;
        $this->fecha_cita = $fecha;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('barbershop@gmail.com', 'Barber Shop'),
            subject: 'Usted tiene una cita proxima!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.notificationEstado',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
