<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRhythmFeatureOccurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rhythm_feature_occurrences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_signature_id')->constrained();
            $table->foreignId('rhythm_feature_id')->constrained();
            $table->foreignId('difficulty_id')->constrained();
            $table->double('probability');
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
        Schema::dropIfExists('rhythm_feature_occurences');
    }
}
