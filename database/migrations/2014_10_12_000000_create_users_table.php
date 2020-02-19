<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('password')->bcrypt();
           // $table->string('confirm_password');
            $table->string('mobile_no');
            $table->string('isadmin')->default(0);
            $table->string('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softdeletes();   
        
           /* $table->integer('phoneno');
            $table->decimal('lattitude',5,2);
            $table->decimal('longtitude',5,2);
            $table->boolean('status');*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
