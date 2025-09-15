<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * @property-read \App\Models\LaudoPendente|null $laudoPendente
 * @property-read \App\Models\Sala|null $sala
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Espera newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Espera newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Espera query()
 * @mixin \Eloquent
 */
class Espera extends Model
{
    // Não precisa de uma tabela extra se for manipular salas
    protected $fillable = ['sala_id', 'user_id'];

    // Relacionamento com a Sala
    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    // Relacionamento com o LaudoPendente
    public function laudoPendente()
    {
        return $this->hasOne(LaudoPendente::class, 'sala_id')->where('user_id', auth()->id());
    }

    // Método para checar o status do laudo
    public function verificarCondicaoLaudo()
    {
        $laudo = $this->laudoPendente;

        if ($laudo) {
            return $laudo->condicao;  // "pendente", "aprovado" ou "rejeitado"
        }

        return null; // Se não houver laudo pendente
    }

    // Verificar se a conversa está dentro do limite para entrar
    public function podeEntrar()
    {
        $sala = $this->sala;
        $dataHoraSala = Carbon::parse($sala->data . ' ' . $sala->hora);
        $agora = Carbon::now();

        return $dataHoraSala->diffInMinutes($agora, false) <= 5 && $dataHoraSala->diffInMinutes($agora, false) > -60;
    }

    // Método para verificar se o laudo foi aprovado
    public function laudoAprovado()
    {
        return $this->verificarCondicaoLaudo() === 'aprovado';
    }

    // Método para verificar se o laudo foi rejeitado
    public function laudoRejeitado()
    {
        return $this->verificarCondicaoLaudo() === 'rejeitado';
    }

    // Método para verificar se o laudo está pendente
    public function laudoPendenteCondicao()
    {
        return $this->verificarCondicaoLaudo() === 'pendente';
    }
}