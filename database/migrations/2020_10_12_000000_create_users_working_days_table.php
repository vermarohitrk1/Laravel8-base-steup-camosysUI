<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_working_days', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('sunday')->default(false); 
            $table->boolean('monday')->default(true);
            $table->boolean('tuesday')->default(true); 
            $table->boolean('wednesday')->default(true); 
            $table->boolean('thursday')->default(true); 
            $table->boolean('friday')->default(true); 
            $table->boolean('saturday')->default(true); 
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
        Schema::dropIfExists('users_working_days');
    }
}
