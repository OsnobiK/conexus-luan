<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Sala extends Model
{
    protected $fillable = [
        'tema',
        'descricao',
        'data',
        'hora',
        'numero_participantes',
        'nome_medico',
        'laudo_obrigatorio',
        'usuario_id', // Adicione este campo ao $fillable
    ];
 
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'sala_user')
                    ->withPivot('laudo_path')
                    ->withTimestamps();
    }
    public function getDataHoraCompletaAttribute()
{
    return \Carbon\Carbon::parse($this->data . ' ' . $this->hora)->setTimezone('America/Sao_Paulo');
}
    public function agendamentos()
{
    return $this->belongsToMany(Usuario::class, 'sala_user')
                ->withPivot('laudo_path')
                ->withTimestamps();
}  
    public function salas() {
    return $this->belongsToMany(Usuario::class, 'sala_user')
                ->withPivot('laudo_path')
                ->withTimestamps();
}
    // Relação com LaudoPendente
 
    public function laudoPendente()
{
    return $this->hasOne(\App\Models\LaudoPendente::class, 'sala_id')->where('user_id', auth()->id());
}
 
public function laudosPendentes()
{
    return $this->hasMany(\App\Models\LaudoPendente::class, 'sala_id');
}
}