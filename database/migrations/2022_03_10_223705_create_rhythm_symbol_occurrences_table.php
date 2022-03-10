<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRhythmSymbolOccurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rhythm_symbol_occurrences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rhythm_symbol_id')->constrained();
            $table->foreignId('rhythm_feature_id')->constrained();
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
        Schema::dropIfExists('rhythm_symbol_occurrences');
    }
}
