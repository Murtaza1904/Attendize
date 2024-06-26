<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();

        $this->call('CountriesSeeder');
        $this->call('CurrencySeeder');
        $this->call('OrderStatusSeeder');
        $this->call('PaymentGatewaySeeder');
        $this->call('QuestionTypesSeeder');
        $this->call('TicketStatusSeeder');
        $this->call('TimezoneSeeder');
        $this->call('RefundPolicySeeder');

    }
}
