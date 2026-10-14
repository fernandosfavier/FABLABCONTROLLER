<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emprestimo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('sala_id');

            $table->foreign('funcionario_id')
                ->references('id')
                ->on('funcionario')
                ->onDelete('cascade');

            $table->foreign('sala_id')
                ->references('id')
                ->on('sala')
                ->onDelete('cascade');

            $table->dateTime('data_retirada');
            $table->dateTime('data_prevista_devolucao')->nullable();
            $table->dateTime('data_devolucao')->nullable();
            $table->string('status')->default('Aberto');
            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprestimo');
    }
};