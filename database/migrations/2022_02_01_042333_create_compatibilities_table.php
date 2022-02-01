<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompatibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compatibilities', function (Blueprint $table) {
            $table->unsignedBigInteger('first_id');
            $table->unsignedBigInteger('second_id');
            $table->unsignedTinyInteger('compatibility')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();

            $table->primary(['first_id', 'second_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compatibilities');
    }
}
