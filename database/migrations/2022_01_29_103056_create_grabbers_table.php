<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrabbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grabbers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link');
            $table->text('articleBody');
            $table->string('gender');
            $table->string('nationality');
            $table->char('letter', 5);
            $table->string('religion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grabbers');
    }
}
