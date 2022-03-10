<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRhythmExerciseSymbolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rhythm_exercise_symbols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rhythm_exercise_id')->constrained();
            $table->foreignId('rhythm_symbol_id')->constrained();
            $table->integer('sequence');
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
        Schema::dropIfExists('rhythm_exercise_symbols');
    }
}
