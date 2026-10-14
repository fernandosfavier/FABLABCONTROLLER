<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipamento', function (Blueprint $table) {
            $table->id();
            $table->string('patrimonio')->unique();
            $table->string('nome');
            $table->string('tipo');
            $table->string('modelo')->nullable();
            $table->string('status')->default('Disponivel');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipamento');
    }
};