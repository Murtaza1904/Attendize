<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServerErrorMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $exception;

    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    public function build()
    {
        return $this->markdown('Emails.server-error-mail', [
            'exception' => $this->exception,
        ]);
    }
}
