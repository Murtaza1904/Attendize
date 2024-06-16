<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUniqueInEventDiscountCodesTable extends Migration
{
    public function up()
    {
        Schema::table('event_discount_codes', function (Blueprint $table) {
            $table->dropUnique(['code']);
        });
    }

    public function down()
    {
        Schema::table('event_discount_codes', function (Blueprint $table) {
            $table->unique('code');
        });
    }
}
