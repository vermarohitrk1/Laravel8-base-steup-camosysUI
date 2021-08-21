<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('payout_type')->nullable(); 
            $table->string('hourly_rate')->nullable(); 
            $table->string('daily_rate')->nullable(); 
            $table->string('weekly_rate')->nullable(); 
            $table->string('monthly_rate')->nullable(); 
            $table->string('overtime_rate')->nullable();
            $table->string('working_shift')->nullable();
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->string('default_payout_method')->nullable();
            $table->string('pay_schedule')->nullable();
            $table->string('payout_date')->nullable();
            $table->string('threshold')->nullable();
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
        Schema::dropIfExists('payrates');
    }
}
