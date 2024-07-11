<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePupilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pupil', function (Blueprint $table) {
            $table->string('pupilID', 25)->primary();
            $table->string('userName', 25);
            $table->string('firstName', 25);
            $table->string('lastName', 25);
            $table->string('email', 50);
            $table->date('D_O_B');
            $table->string('schoolRegNo', 25);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pupil');
    }
}
