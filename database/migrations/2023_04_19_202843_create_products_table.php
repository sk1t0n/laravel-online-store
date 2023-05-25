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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 20);
            $table->decimal('price', 8, 2)->default(0);
            $table->unsignedBigInteger('category_id')->index();
            $table
                ->foreign('category_id')
                ->on('categories')
                ->references('id')
                ->cascadeOnUpdate()
                ->nullOnDelete()
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
