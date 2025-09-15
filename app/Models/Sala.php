<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sala newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sala newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sala query()
 * @mixin \Eloquent
 */
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
    ];

}
