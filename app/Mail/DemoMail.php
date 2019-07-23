<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DemoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $messages;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $remitent = env('EMAIL_REMITENT');
        $count = $this->messages->count();
        $dateString = Carbon::now()->subDay()->toDateString();

        return $this->from($remitent)
            ->subject("Resumen de mensajes ($count) - $dateString")
            ->view('mails.digest')
            ->with(['messages' => $this->messages]);
    }
}
