<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('sala_user', function (Blueprint $table) {
        $table->boolean('laudo_enviado')->default(false)->after('laudo_path');
    });
}
 
public function down()
{
    Schema::table('sala_user', function (Blueprint $table) {
        $table->dropColumn('laudo_enviado');
    });
}
};