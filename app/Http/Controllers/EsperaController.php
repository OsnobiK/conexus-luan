<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Espera;
use App\Models\Sala;
 
class EsperaController extends Controller
{
    public function salasAgendadas()
{
    $userId = auth()->id;
 
    // Carrega salas com laudos pendentes do usuário atual
    $salas = \App\Models\Sala::with([
        'laudosPendentes' => function($query) use ($userId) {
            $query->where('user_id', $userId);
        }
    ])
    ->whereHas('usuarios', function($query) use ($userId) {
        $query->where('usuario_id', $userId);
    })
    ->orderBy('data')
    ->orderBy('hora')
    ->get();
 
    $salasFiltradas = $salas->filter(function ($sala) use ($userId) {
        // ⚠️ Filtrar o laudo corretamente usando where user_id
        $laudoDoUsuario = $sala->laudosPendentes->first(function ($laudo) use ($userId) {
            return $laudo->user_id == $userId;
        });
 
        // Se tiver laudo pendente ou aprovado, exibe
        if ($laudoDoUsuario && in_array($laudoDoUsuario->condicao, ['pendente', 'aprovado'])) {
            return true;
        }
 
        // Ou se a sala não exigir laudo
        return !$sala->laudo_obrigatorio;
    });
 
    return view('espera-de-salas', compact('salasFiltradas'));
    }
}