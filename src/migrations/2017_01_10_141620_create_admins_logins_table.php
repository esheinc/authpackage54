<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Admins_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('status')->comment('0=unsuccessful,1=successful');
            $table->string('ip');
            $table->string('geo');
            $table->string('language');
            $table->string('device')->nullable();
            $table->string('os');
            $table->string('browser');
            $table->string('browser_version');
            $table->string('agent');
            $table->string('agent_version');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins_logins');
    }
}
