<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_representative', function (Blueprint $table) {
            $table->string('repId', 25)->primary();
            $table->string('schoolRegNo', 25)->foreign();
            $table->string('repName', 25);
            $table->string('password', 25);
            $table->string('email', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_representative');
    }
}
