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
        Schema::create('servicio', function (Blueprint $table) {
            $table->unsignedBigInteger('id_barbero');
            $table->unsignedBigInteger('id_cliente');

            $table->id();
            $table->foreign('id_barbero')->references('id')->on('barbero');
            $table->foreign('id_cliente')->references('id')->on('cliente');
            $table->string('titulo');
            $table->string('descripcion');
            $table->decimal('precio');
            $table->string('tiempo_estimado');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio');
    }
};
