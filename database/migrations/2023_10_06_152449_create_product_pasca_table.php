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
        Schema::create('product_pasca', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_category');
            $table->string('product_provider');
            $table->string('product_seller');
            $table->integer('product_transaction_admin');
            $table->integer('product_transaction_fee');
            $table->string('product_sku');
            $table->timestamps();

            $table->unique('product_sku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_pasca');
    }
};
