<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoregisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('georegister', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('password')->bcrypt();
           // $table->string('confirm_password');
            $table->string('mobile_no')->unique();
            $table->string('isadmin')->default(0);
            $table->string('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softdeletes();   
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('georegister');
    }
}
