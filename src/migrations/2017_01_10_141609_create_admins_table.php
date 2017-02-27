<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Admins', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('parent_id');
            $table->integer('level')->comment('0=root,1=superadmin,2=admin');
            $table->integer('status')->comment('0=disabled,1=enabled');
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip');
            $table->string('last_login_geo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
