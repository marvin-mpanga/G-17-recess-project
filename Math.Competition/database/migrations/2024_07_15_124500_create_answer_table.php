<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer', function (Blueprint $table) {
            $table->string('answerID', 25)->primary();
            $table->string('answerNo', 5);
            $table->string('challengeId', 12)->foreign();
            $table->string('correctAnswer', 'created_at')->nullable();
            $table->string('questionID', 25)->foreign();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer');
    }
}
