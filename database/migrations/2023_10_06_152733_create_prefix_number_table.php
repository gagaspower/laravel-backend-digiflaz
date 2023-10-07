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
        Schema::create('prefix_number', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('provider');
            $table->timestamps();

            $table->unique('number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefix_number');
    }
};
