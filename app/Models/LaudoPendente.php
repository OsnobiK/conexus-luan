<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $sala_id
 * @property string $caminho_arquivo
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Sala|null $sala
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente whereCaminhoArquivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente whereSalaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LaudoPendente whereUserId($value)
 * @mixin \Eloquent
 */
class LaudoPendente extends Model
{
    use HasFactory;

    // 👇 Adicione esta linha
    protected $table = 'laudos_pendentes';

    protected $fillable = [
        'user_id',
        'sala_id',
        'caminho_arquivo',
        'condicao',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function sala()
    {
        return $this->belongsTo(\App\Models\Sala::class, 'sala_id');
    }
}
