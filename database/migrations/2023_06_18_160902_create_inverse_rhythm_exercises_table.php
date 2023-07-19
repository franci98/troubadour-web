<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInverseRhythmExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('inverse_rhythm_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bar_info_id')->constrained();
            $table->foreignId('exercise_id')->constrained();
            $table->integer('BPM');
            $table->unsignedInteger('rhythm_level');
            $table->boolean('mp3_generated')->nullable();
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
        Schema::dropIfExists('inverse_rhythm_exercises');
    }
}
