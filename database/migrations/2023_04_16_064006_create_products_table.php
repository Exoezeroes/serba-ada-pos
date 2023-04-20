<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->unsignedInteger('buy_price');
            $table->unsignedInteger('sell_price');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->unique(['uid', 'sell_price']);
        });

        // sell price must be larger than buy price
        // DB::statement(
        //     'ALTER TABLE products 
        //     ADD CONSTRAINT chk_sell_price 
        //     CHECK (sell_price >= buy_price);'
        // );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
