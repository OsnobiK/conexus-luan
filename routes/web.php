<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LaudoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\LaudoPendenteController;
use App\Http\Controllers\EsperaController;


/*
|--------------------------------------------------------------------------
| Rotas Públicas (acessíveis por todos)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Rotas de Cadastro de Usuário
Route::get('/cadastro', [CadastroController::class, 'showRegistrationForm'])->name('cadastro.create');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');

// Rotas de Cadastro de Médico
Route::get('/cadastromedico', [MedicoController::class, 'create'])->name('cadastromedico.create');
Route::post('/cadastromedico', [MedicoController::class, 'store'])->name('cadastromedico.store');

// Rotas de Autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas para recuperação de senha
Route::get('/recuperacao', fn() => view('recuperacao'))->name('recuperacao');
Route::get('/redefinicao', fn() => view('redefinicao'))->name('redefinicao');

// Rotas de páginas estáticas
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/termos-de-servico', 'termos-de-servico')->name('termos');
Route::view('/escolha', 'escolha')->name('escolha');
Route::view('/abordagem', 'abordagem')->name('abordagem');
Route::view('/agenda', 'agenda')->name('agenda');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (requerem autenticação)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Área principal do usuário
    Route::get('/area-user', function () {
        return view('area-user');
    })->name('area-user');

    // Rotas de Perfil (acessíveis por user e medico)
    Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil/editar', [ProfileController::class, 'update'])->name('perfil.update');

    // --- GRUPO DE ROTAS PARA SALAS ---
        Route::prefix('salas')->name('salas.')->group(function () {
        Route::get('/espera-de-salas', [EsperaController::class, 'salasAgendadas'])->name('espera')->middleware('auth');
        Route::get('/', [SalaController::class, 'index'])->name('index');
        Route::post('/{id}/agendar', [SalaController::class, 'agendar'])->name('agendar');
        Route::get('/minhas-agendadas', [SalaController::class, 'salasAgendadas'])->name('agendadas');
        Route::get('/salas', [SalaController::class, 'index'])->name('salas.index');
        Route::get('/criar-salas', [SalaController::class, 'create'])->name('salas.create');
        Route::post('/salas', [SalaController::class, 'store'])->name('salas.store');

        // Rotas que SÓ MÉDICOS podem acessar
        Route::middleware('role:medico')->group(function () {
            Route::get('/criar', [SalaController::class, 'create'])->name('create');
            Route::post('/', [SalaController::class, 'store'])->name('store');
            Route::get('/criadas', [SalaController::class, 'minhasSalas'])->name('criadas');
            Route::get('/{id}/editar', [SalaController::class, 'edit'])->name('edit');
            Route::put('/{id}', [SalaController::class, 'update'])->name('update');
        });
    });

    // --- ROTAS DE LAUDOS (Paciente) ---
    Route::get('/cadastrolaudo', [LaudoController::class, 'create'])->name('cadastrolaudo');
    Route::post('/laudo', [LaudoController::class, 'store'])->name('laudo.store');
    
    // --- ROTAS DE GESTÃO DE LAUDOS PENDENTES (Médico) ---
    Route::middleware('role:medico')->prefix('laudos-pendentes')->name('laudo.pendente.')->group(function () {
        Route::get('/', [LaudoPendenteController::class, 'index'])->name('index');
        // A criação/envio de laudo é feita pelo paciente no agendamento, então essas rotas podem não ser necessárias aqui.
        // Route::get('/novo', [LaudoPendenteController::class, 'create'])->name('create');
        // Route::post('/enviar', [LaudoPendenteController::class, 'store'])->name('store');
        Route::post('/{id}/aprovar', [LaudoPendenteController::class, 'approve'])->name('approve');
        Route::post('/{id}/rejeitar', [LaudoPendenteController::class, 'reject'])->name('reject');
    });

});

