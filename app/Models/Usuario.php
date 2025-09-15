<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <<-- IMPORTANTE para autenticação
use App\Models\LaudoPendente;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $cpf
 * @property string $telefone
 * @property string|null $cidade
 * @property string $email
 * @property string $role
 * @property string|null $profile_image
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Laudo|null $laudo
 * @property-read \Illuminate\Database\Eloquent\Collection<int, LaudoPendente> $laudosPendentes
 * @property-read int|null $laudos_pendentes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sala> $salas
 * @property-read int|null $salas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereProfileImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereTelefone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Usuario whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Usuario extends Authenticatable // <<-- Extende Authenticatable para poder logar usuários
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuarios'; // <<-- INFORMA AO MODEL QUE A TABELA É 'usuarios'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cpf',
        'telefone',
        'email',
        'password',
        'role', // O campo da senha no banco de dados deve ser 'password'
    ]; // <<-- Inclua todos os campos que serão preenchidos via mass assignment

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


   


     public function salas()
{
    return $this->belongsToMany(Sala::class, 'sala_user')
                ->withPivot('laudo_path', 'laudo_enviado')
                ->withTimestamps();
}
    // Verifica se o usuário tem laudo cadastrado
public function laudo()
{
    return $this->hasOne(Laudo::class, 'usuario_id');
}

public function temLaudo()
{
    return $this->laudo()->exists();
    return $this->laudosPendentes()->exists();
}

 public function laudosPendentes(): HasMany
    {
        return $this->hasMany(LaudoPendente::class, 'user_id');
    }
}
