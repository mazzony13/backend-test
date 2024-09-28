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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id');
            $table->foreignId('product_id');
            $table->float('value');

             //user  type relationship
             $table->foreign('type_id')
             ->on('user_types')
             ->references('id')
             ->cascadeOnUpdate()->cascadeOnDelete();

            //product relationship
            $table->foreign('product_id')
            ->on('products')
            ->references('id')
            ->cascadeOnUpdate()->cascadeOnDelete();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
