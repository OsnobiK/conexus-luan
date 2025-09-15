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
        Schema::create('medicos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('cpf')->unique()->nullable();
        $table->string('especialidade')->nullable();
        $table->string('crm')->unique()->nullable();
        $table->string('telefone')->nullable();
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable(); // Opcional, se for usar verificação de email
        $table->rememberToken();
        $table->string('password');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};