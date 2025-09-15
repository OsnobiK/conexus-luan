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
        Schema::table('medicos', function (Blueprint $table) {
            // Vamos remover as colunas que já existem na tabela 'usuarios'
            $table->dropColumn([
                'nome',
                'cpf',
                'email',
                'telefone',
                'password',
                'email_verified_at',
                'remember_token'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Este método permite reverter a alteração, se necessário
        Schema::table('medicos', function (Blueprint $table) {
            $table->string('nome');
            $table->string('cpf')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('telefone')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }
};