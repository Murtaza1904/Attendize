<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginOTPMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function build()
    {
        return $this->subject('Login Verification Code')
                    ->view('Emails.clients.login-otp');
    }
}
