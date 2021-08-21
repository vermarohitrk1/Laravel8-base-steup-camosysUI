<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('total_amount')->nullable();
            $table->boolean('status')->default(true);
            $table->string('badge')->nullable();
            $table->string('trial_end')->default('now');
            $table->string('image')->nullable();
            $table->string('mode')->nullable();
            $table->string('type')->default('Regular');
            $table->integer('indexing')->default('0');
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
        Schema::dropIfExists('plans');
    }
}
