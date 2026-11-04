
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario_token', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuario')->onDelete('cascade');
            $table->string('token')->unique();
            $table->timestamp('valido_ate');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_token');
    }
};
