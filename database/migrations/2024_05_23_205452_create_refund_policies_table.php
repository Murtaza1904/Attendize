<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundPoliciesTable extends Migration
{
    public function up()
    {
        Schema::create('refund_policies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('first_checkbox_text');
            $table->text('second_checkbox_text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('refund_policies');
    }
}
