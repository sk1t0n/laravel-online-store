<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('cart_id')->index();
            $table
                ->foreign('cart_id')
                ->on('carts')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;
            $table->unsignedBigInteger('product_id')->index();
            $table
                ->foreign('product_id')
                ->on('products')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
