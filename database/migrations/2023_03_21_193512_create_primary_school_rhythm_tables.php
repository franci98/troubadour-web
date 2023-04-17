<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimarySchoolRhythmTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary_school_bar_infos', function (Blueprint $table) {
            $table->id();
            $table->json('bar_info');
            $table->integer('min_rhythm_level');
            $table->double('probability');
        });

        Schema::create('primary_school_rhythm_bars', function (Blueprint $table) {
            $table->id();
            $table->json('content');
            $table->double('length');

            // Marks a bar splitter
            // If set, it will be used to split a bar
            // length in quarter notes - how much space does the element occupy in the first bar
            $table->double('cross_bar')->nullable();
            $table->softDeletes();
            $table->double('rests')->nullable();
        });


        Schema::create('primary_school_rhythm_features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('min_occurrences')->nullable();
            $table->unsignedInteger('max_occurrences')->nullable();
            $table->boolean('cross_bar')->default(false);
        });

        Schema::create('primary_school_rhythm_bar_occurrences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_school_rhythm_bar_id');
            $table->unsignedBigInteger('primary_school_rhythm_feature_id');
            $table->double('bar_probability')->default(0.5);

            $table->unique(['primary_school_rhythm_bar_id', 'primary_school_rhythm_feature_id'], 'ps_rhythm_bar_feat_unique');

            $table->foreign('primary_school_rhythm_bar_id', 'ps_rhythm_bar_feat_bar_id_foreign')
                ->references('id')
                ->on('primary_school_rhythm_bars')
                ->onDelete('cascade');
            $table->foreign('primary_school_rhythm_feature_id', 'ps_rhythm_bar_feat_feat_id_foreign')
                ->references('id')
                ->on('primary_school_rhythm_features')
                ->onDelete('cascade');
        });

        Schema::create('primary_school_rhythm_feature_occurrences', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rhythm_level');
            $table->unsignedBigInteger('primary_school_rhythm_feature_id');
            $table->foreign('primary_school_rhythm_feature_id', 'ps_rhythm_feat_occ_feat_id_foreign')
                ->references('id')
                ->on('primary_school_rhythm_features');
            $table->unsignedBigInteger('primary_school_bar_info_id');
            $table->foreign('primary_school_bar_info_id', 'ps_rhythm_feat_occ_bar_info_id_foreign')
                ->references('id')
                ->on('primary_school_bar_infos');
            $table->double('feature_probability')->default(0.5);
        });


        Schema::create('primary_school_rhythm_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_school_bar_info_id');
            $table->foreign('primary_school_bar_info_id', 'ps_rhythm_exercise_bar_info_id_foreign')
                ->references('id')
                ->on('primary_school_bar_infos');
            $table->foreignId('exercise_id')->constrained();
            $table->integer('BPM');
            $table->unsignedInteger('rhythm_level');
            $table->boolean('mp3_generated')->nullable();
            $table->timestamps();
        });

        Schema::create('primary_school_rhythm_exercise_bars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_school_rhythm_exercise_id');
            $table->foreign('primary_school_rhythm_exercise_id', 'ps_rhythm_exercise_bar_exercise_id_foreign')
                ->references('id')
                ->on('primary_school_rhythm_exercises');
            $table->unsignedBigInteger('primary_school_rhythm_bar_id');
            $table->foreign('primary_school_rhythm_bar_id', 'ps_rhythm_exercise_bar_bar_id_foreign')
                ->references('id')
                ->on('primary_school_rhythm_bars');
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
        Schema::dropIfExists('primary_school_rhythm_exercise_bars');
        Schema::dropIfExists('primary_school_rhythm_exercises');
        Schema::dropIfExists('primary_school_rhythm_feature_occurrences');
        Schema::dropIfExists('primary_school_rhythm_bar_occurrences');
        Schema::dropIfExists('primary_school_rhythm_features');
        Schema::dropIfExists('primary_school_rhythm_bars');
        Schema::dropIfExists('primary_school_bar_infos');
    }
}
