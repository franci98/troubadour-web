<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRhythmQuizExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rhythm_quiz_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bar_info_id')->constrained();
            $table->foreignId('exercise_id')->constrained();
            $table->integer('BPM');
            $table->unsignedInteger('rhythm_level');
            $table->boolean('mp3_generated')->nullable();
            $table->timestamps();
        });

        Schema::create('rhythm_quiz_exercise_bars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rhythm_quiz_exercise_id')->constrained();
            $table->foreignId('rhythm_bar_id')->constrained();
            $table->integer('seq');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rhythm_quiz_exercise_bars');
        Schema::dropIfExists('rhythm_quiz_exercises');
    }
}
