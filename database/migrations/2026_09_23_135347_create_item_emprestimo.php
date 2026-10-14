<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_emprestimo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('emprestimo_id');
            $table->unsignedBigInteger('equipamento_id');

            $table->foreign('emprestimo_id')
                ->references('id')
                ->on('emprestimo')
                ->onDelete('cascade');

            $table->foreign('equipamento_id')
                ->references('id')
                ->on('equipamento')
                ->onDelete('cascade');

            $table->string('estado_retirada')->nullable();
            $table->string('estado_devolucao')->nullable();
            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_emprestimo');
    }
};