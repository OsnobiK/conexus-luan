<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up()
    {
        Schema::create('laudos', function (Blueprint $table) {
            $table->id();

            // FK para usuários
        $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
 
            // Dados do paciente
            $table->string('nome', 120);
            $table->date('data_nascimento');
            $table->string('rg', 10);
            $table->string('cpf', 11); // CPF sem pontuação
 
            // Dados do médico
            $table->string('medico', 120);
            $table->string('crm', 10);
            $table->string('especialidade', 120);
            $table->string('contato_medico', 15);
 
            // Informações do laudo
            $table->text('detalhes'); // até 1000 caracteres
            $table->string('diagnostico', 120);
            $table->string('arquivo_pdf')->nullable();
 
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('laudos');
    }
};
