<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Foundation\Auth\User as Authenticatable;// se quiser autenticação
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string|null $especialidade
 * @property string|null $crm
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $usuario_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico whereCrm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico whereEspecialidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medico whereUsuarioId($value)
 * @mixin \Eloquent
 */
class Medico extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
       'usuario_id',
        'especialidade',
        'crm',
        
    ];

    protected $hidden = ['password'];
}