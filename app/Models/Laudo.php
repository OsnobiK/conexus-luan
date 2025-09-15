<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $usuario_id
 * @property string $nome
 * @property string $data_nascimento
 * @property string $rg
 * @property string $cpf
 * @property string $medico
 * @property string $crm
 * @property string $especialidade
 * @property string $contato_medico
 * @property string $detalhes
 * @property string $diagnostico
 * @property string|null $arquivo_pdf
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereArquivoPdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereContatoMedico($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereCrm($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereDataNascimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereDetalhes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereDiagnostico($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereEspecialidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereMedico($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereRg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Laudo whereUsuarioId($value)
 * @mixin \Eloquent
 */
class Laudo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_nascimento',
        'rg',
        'cpf',
        'medico',
        'crm',
        'especialidade',
        'contato_medico',
        'detalhes',
        'diagnostico',
        'arquivo_pdf',
        'usuario_id',
        'condicao', // Adicione este campo se usar status no laudo definitivo
    ];
}
