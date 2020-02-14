<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeotagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geotag', function (Blueprint $table) {
            $table->bigIncrements('tag_id');
            $table->string('title');
            $table->string('description');
            $table->string('upload_image');
            $table->string('upload_video');
            $table->string('tag_keyword');
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
        Schema::dropIfExists('geotag');
    }
}
