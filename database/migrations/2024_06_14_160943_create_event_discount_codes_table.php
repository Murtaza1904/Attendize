<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventDiscountCodesTable extends Migration
{
    public function up()
    {
        Schema::create('event_discount_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('event_id')->index();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->string('code')->unique();
            $table->double('discount_percentage');
            $table->unsignedMediumInteger('limit');
            $table->unsignedMediumInteger('usage')->default(0);
            $table->date('expiry_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_discount_codes');
    }
}
