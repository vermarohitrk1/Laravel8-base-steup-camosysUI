<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('slug'); 
            $table->string('product_id');
            $table->string('price')->nullable(); 
            $table->string('price_id')->nullable();
            $table->string('active'); 
            $table->string('currency')->nullable();
            $table->boolean('tiered')->default(false)->nullable();
            $table->string('interval')->nullable(); 
            $table->string('description')->nullable();
            $table->string('attributes')->nullable(); 
            $table->string('images')->nullable();
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
        Schema::dropIfExists('products');
    }
}
