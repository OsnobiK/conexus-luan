<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laudos_pendentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sala_id');
            $table->string('caminho_arquivo');
            $table->enum('condicao', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->timestamps();

            // Chaves estrangeiras (opcional, mas recomendável)
            $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('sala_id')->references('id')->on('salas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laudos_pendentes');
    }
};
