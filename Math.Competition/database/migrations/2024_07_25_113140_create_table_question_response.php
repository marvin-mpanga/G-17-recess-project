<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableQuestionResponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_question_response', function (Blueprint $table) {
            $table->string('responsiveId', 255)->primary();
            $table->string('attemptId', 255);
            $table->string('questionId', 10);
            $table->string('isCorrect', 255);
            $table->time('timetaken');
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
        Schema::dropIfExists('table_question_response');
    }
}
