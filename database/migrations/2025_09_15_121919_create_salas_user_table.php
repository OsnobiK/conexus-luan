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
         Schema::create('sala_user', function (Blueprint $table) {
         $table->id();
         $table->foreignId('sala_id')->constrained()->onDelete('cascade');
         $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->onDelete('cascade');
         $table->string('laudo_path')->nullable();
         $table->timestamps();
 });
     }
 
     /**
      * Reverse the migrations.
      */
     public function down(): void
     {
         Schema::dropIfExists('sala_user');
     }
};
 