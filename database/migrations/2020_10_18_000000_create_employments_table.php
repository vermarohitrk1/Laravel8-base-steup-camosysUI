<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('credentials_number')->nullable();
            $table->date('last_working_day')->nullable(); 
            $table->date('termination_date')->nullable(); 
            $table->date('hire_date')->nullable(); 
            $table->date('previous_terminate_date')->nullable(); 
            $table->date('re_hire_date')->nullable();  
            $table->string('termination_note')->nullable(); 
            $table->string('notice_period')->default('0'); 
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('employments');
    }
}
