<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRhythmExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bar_infos', function (Blueprint $table) {
            $table->id();
            $table->json('bar_info');
            $table->unsignedInteger('min_rhythm_level');
        });

        Schema::create('rhythm_bars', function (Blueprint $table) {
            $table->id();
            $table->json('content');
            $table->double('length');

            // Marks a bar splitter
            // If set, it will be used to split a bar
            // length in quarter notes - how much space does the element occupy in the first bar
            $table->double('cross_bar')->nullable();
            $table->double('rests');
            $table->softDeletes();
        });


        Schema::create('rhythm_features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('min_occurrences')->nullable();
            $table->unsignedInteger('max_occurrences')->nullable();
            $table->boolean('cross_bar')->default(false);
        });

        Schema::create('rhythm_bar_occurrences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rhythm_bar_id')->constrained();
            $table->foreignId('rhythm_feature_id')->constrained();
            $table->double('bar_probability')->default(0.5);

            $table->unique(['rhythm_bar_id', 'rhythm_feature_id'], 'rhythm_bar_feature_unique');
        });

        Schema::create('rhythm_feature_occurrences', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rhythm_level');
            $table->foreignId('rhythm_feature_id')->constrained();
            $table->foreignId('bar_info_id')->constrained();
            $table->double('feature_probability')->default(0.5);
        });


        Schema::create('rhythm_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bar_info_id')->constrained();
            $table->foreignId('exercise_id')->constrained();
            $table->integer('BPM');
            $table->unsignedInteger('rhythm_level');
            $table->boolean('mp3_generated')->nullable();
            $table->timestamps();
        });

        Schema::create('rhythm_exercise_bars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rhythm_exercise_id')->constrained();
            $table->foreignId('rhythm_bar_id')->constrained();
            $table->integer('seq');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('difficulty_id')->nullable();
        });

        Schema::table('games', function(Blueprint $table) {
            $table->unsignedInteger('rhythm_level')->nullable();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->unsignedInteger("rhythm_level")->default(11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('rhythm_level');
        });

        Schema::table('games', function(Blueprint $table) {
            $table->dropColumn('rhythm_level');
        });


        Schema::dropIfExists('rhythm_exercise_bars');
        Schema::dropIfExists('rhythm_exercises');
        Schema::dropIfExists('rhythm_feature_occurrences');
        Schema::dropIfExists('rhythm_bar_occurrences');
        Schema::dropIfExists('rhythm_features');
        Schema::dropIfExists('rhythm_bars');
        Schema::dropIfExists('bar_infos');
    }
}
