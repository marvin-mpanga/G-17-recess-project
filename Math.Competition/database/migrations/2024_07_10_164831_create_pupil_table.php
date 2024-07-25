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
            $table->string('pupilID')->default(DB::raw('UUID()'))->primary();
            $table->string('userName', 25)->default('default_userName');
            $table->string('name', 25)->default('default_name');
            $table->string('email', 50)->default('email');
            $table->date('D_O_B')->default('2000-01-01');
            $table->string('schoolRegNo', 25)->default('REG-0000')->foreign();
            $table->string('password', 255)->default('default_password');
            $table->dropColumn('profile_picture', 255)->default('default_profile_picture');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            

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
