<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentGatewayInRegionTaxesTable extends Migration
{
    public function up()
    {
        Schema::table('region_taxes', function (Blueprint $table) {
            $table->string('payment_gateway')->default('stripe-ca');
        });
    }

    public function down()
    {
        Schema::table('region_taxes', function (Blueprint $table) {
            $table->dropColumn('payment_gateway');
        });
    }
}
