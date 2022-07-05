<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exercise_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('solving_time')->nullable();
            $table->integer('number_of_attempts');
            $table->integer('deletions');
            $table->integer('level');
            $table->integer('sound_replays');
            $table->double('score');
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
        Schema::dropIfExists('answers');
    }
}
