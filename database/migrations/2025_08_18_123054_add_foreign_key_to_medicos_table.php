<?php 


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicos', function (Blueprint $table) {
            // Adiciona a coluna e a restrição de chave estrangeira
            // Esta é a forma moderna e recomendada no Laravel
            $table->foreignId('usuario_id')
                  ->constrained('usuarios') // 'usuarios' é o nome da tabela referenciada
                  ->onDelete('cascade'); // Se um usuário for deletado, o médico correspondente também será
        });
    }

    public function down(): void
    {
        Schema::table('medicos', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna
            $table->dropForeign(['usuario_id']);
            $table->dropColumn('usuario_id');
        });
    }
};