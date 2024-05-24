<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegionTaxIdInEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('region_tax_id')->default(2)->after('organiser_fee_percentage');
            $table->foreign('region_tax_id')->references('id')->on('region_taxes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['region_tax_id']);
            $table->dropColumn('region_tax_id');
        });
    }
}
