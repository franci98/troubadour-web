<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homework_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homework_id');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();

            $table->foreign('homework_id')->references('id')->on('homeworks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homework_user');
    }
}
