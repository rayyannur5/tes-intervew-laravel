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
        Schema::create('spkos', function (Blueprint $table) {
            $table->integer('id_spko', true)->length(11);
            $table->text('remarks')->nullable();
            $table->integer('employee');
            $table->date('trans_date');
            $table->string('process', 15);
            $table->string('sw', 25);
            $table->timestamps();
            
            $table->foreign('employee')->references('id_employee')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spkos');
    }
};
