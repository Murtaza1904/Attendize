<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInAttendeesTable extends Migration
{
    public function up()
    {
        Schema::table('attendees', function (Blueprint $table) {
            $table->unsignedMediumInteger('number_of_attendees')->nullable();
            $table->unsignedMediumInteger('number_of_children')->nullable();
            $table->text('note')->nullable();
        });
    }

    public function down()
    {
        Schema::table('attendees', function (Blueprint $table) {
            $table->dropColumn('number_of_attendees');
            $table->dropColumn('number_of_children');
            $table->dropColumn('note');
        });
    }
}
