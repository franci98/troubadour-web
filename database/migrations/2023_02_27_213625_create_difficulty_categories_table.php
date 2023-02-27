<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDifficultyCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('difficulty_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('sequence')->default(1);
            $table->boolean('is_active')->default(true);
            $table->foreignId('game_type_id')->constrained('game_types');
            $table->timestamps();
        });

        Schema::table('difficulties', function (Blueprint $table) {
            $table->foreignId('difficulty_category_id')->nullable()->constrained('difficulty_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('difficulties', function (Blueprint $table) {
            $table->dropForeign(['difficulty_category_id']);
            $table->dropColumn('difficulty_category_id');
        });
        Schema::dropIfExists('difficulty_categories');
    }
}
