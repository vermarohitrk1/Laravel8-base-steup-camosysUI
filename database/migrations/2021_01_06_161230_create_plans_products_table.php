<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans_products', function (Blueprint $table) {
        	$table->bigInteger('plan_id')->unsigned(); 
             $table->bigInteger('product_id')->unsigned();

             //FOREIGN KEY CONSTRAINTS
             $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
             $table->integer('qty')->nullable();
             //SETTING THE PRIMARY KEYS
            $table->primary(['plan_id','product_id']);
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
        Schema::dropIfExists('plans_products');
    }
}
