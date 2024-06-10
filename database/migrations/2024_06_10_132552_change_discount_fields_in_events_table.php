<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDiscountFieldsInEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->decimal('discount_fix_amount')->nullable()->change();
            $table->decimal('discount_percentage')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedSmallInteger('discount_fix_amount')->nullable()->change();
            $table->unsignedSmallInteger('discount_percentage')->nullable()->change();
        });
    }
}
