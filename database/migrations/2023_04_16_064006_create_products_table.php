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
            $table->id();
            $table->string('uid');
            $table->string('title');
            $table->unsignedInteger('quantity'); // max 4,294,967,295
            $table->unsignedInteger('price');    // same
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unique(['uid', 'price']);
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
