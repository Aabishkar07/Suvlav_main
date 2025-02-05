<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('content')->nullable();
            $table->text('image')->nullable();
            $table->json('images')->default('{}');
            $table->string('prod_code')->nullable();
            $table->string('regular_price')->nullable();
            $table->string('sale_price')->nullable();
            $table->integer('brand_id')->nullable();
            $table->json('prod_categories')->default('{}');
            $table->enum('stock_status', ['1','0']);
            $table->json('prod_sizes')->default('{}');
            $table->json('prod_colors')->default('{}');
            $table->json('payment_options')->default('{}');
            $table->enum('prod_featured', ['0','1'])->nullable();
            $table->enum('prod_new_arrival', ['0','1'])->nullable();
            $table->enum('status', ['1','0'])->nullable();
            $table->string('cp')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
