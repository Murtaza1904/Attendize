<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountFieldsInEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('discount_code')->nullable()->after('organiser_fee_percentage');
            $table->unsignedSmallInteger('discount_fix_amount')->nullable()->after('discount_code');
            $table->unsignedSmallInteger('discount_percentage')->nullable()->after('discount_fix_amount');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('discount_code');
            $table->dropColumn('discount_fix_amount');
            $table->dropColumn('discount_percentage');
        });
    }
}
