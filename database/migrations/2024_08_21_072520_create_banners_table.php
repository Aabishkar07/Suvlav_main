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
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('top_heading')->nullable();            
            $table->string('main_heading')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('image')->nullable();            
            $table->text('btn_name')->nullable();
            $table->text('btn_url')->nullable();            
            $table->enum('display_option', ['1','2','3'])->default('3');
            $table->enum('status', ['1','0'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
