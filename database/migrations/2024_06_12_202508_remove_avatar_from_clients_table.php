<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAvatarFromClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('avatar');
        });
    }
}
