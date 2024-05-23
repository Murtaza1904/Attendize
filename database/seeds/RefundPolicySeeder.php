<?php

use App\RefundPolicy;
use Illuminate\Database\Seeder;

class RefundPolicySeeder extends Seeder
{
    public function run()
    {
        RefundPolicy::create([
            'first_checkbox_text' => 'Tickets are non-refundable. By purchasing tickets for Halal Ribfest through our website, you acknowledge and agree to our&nbsp;<a href="https://www.halalribfest.com/policies#ticket-refund-policy" target="_blank">refund policy</a>, <a href="https://www.halalribfest.com/policies#privacy-policy" target="_blank">privacy policy</a>,&nbsp;<a href="https://www.halalribfest.com/policies#code-of-conduct" target="_blank">code of conduct</a>, and&nbsp;<a href="https://www.halalribfest.com/policies#terms-of-service" target="_blank">terms of services</a>.',
            'second_checkbox_text' => 'By checking this box, I consent to receive ticket details and promotional messages, including offers, from Halal Ribfest via email and SMS. I understand that I can opt out of receiving these messages at any time.',
        ]);
    }
}
