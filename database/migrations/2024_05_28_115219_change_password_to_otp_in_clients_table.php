<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePasswordToOtpInClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('password');
            $table->dropColumn('remember_token');
            $table->string('otp')->nullable()->unique()->index()->after('email');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->dropColumn('otp');
        });
    }
}
