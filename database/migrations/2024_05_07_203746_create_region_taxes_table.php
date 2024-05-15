<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionTaxesTable extends Migration
{
    public function up()
    {
        Schema::create('region_taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('region')->unique();
            $table->enum('tax_type', ['fixed', 'percentage']);
            $table->double('tax');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('region_taxes');
    }
}
