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
        Schema::create('usuarios', function (Blueprint $table) { // <<-- O nome da tabela é 'usuarios'
            $table->id();
            $table->string('name');
            $table->string('cpf')->unique(); // <<-- Adicionado CPF e definido como único
            $table->string('telefone'); // <<-- Adicionado Telefone
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Opcional, se for usar verificação de email
            $table->string('password'); // A coluna da senha no DB deve ser 'password'
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios'); // <<-- Remove a tabela 'usuarios'
    }
};