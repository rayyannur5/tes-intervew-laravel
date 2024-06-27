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
        Schema::create('spko_items', function (Blueprint $table) {
            $table->integer('idm')->length(11);
            $table->integer('ordinal')->length(11);
            $table->integer('id_product')->length(11);
            $table->integer('qty');
            $table->timestamps();
            
            $table->foreign('idm')->references('id_spko')->on('spkos');
            $table->foreign('id_product')->references('id_product')->on('products');
            $table->primary(['idm', 'ordinal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spko_items');
    }
};
