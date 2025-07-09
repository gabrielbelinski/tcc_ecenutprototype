<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConsultaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return inertia('Index/Index');
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('usuario', UsuarioController::class)->names([
        'index' => 'usuario.index',
        'create' => 'usuario.create',
        'edit' => 'usuario.edit',
        'update' => 'usuario.update',
        'show' => 'usuario.show',
        'store' => 'usuario.store',
        'destroy' => 'usuario.destroy'
    ]);

    Route::resource('paciente', PacienteController::class)->names([
        'index' => 'paciente.index',
        'create' => 'paciente.create',
        'edit' => 'paciente.edit',
        'update' => 'paciente.update',
        'show' => 'paciente.show',
        'store' => 'paciente.store',
        'destroy' => 'paciente.destroy',
        'searchPaciente' => 'paciente.searchPaciente'
    ]);
    Route::get('/consulta/searchPaciente', [ConsultaController::class, 'searchPaciente']);
    Route::prefix('consulta/atendimento')->group(function () {
        Route::get('/', [ConsultaController::class, 'atendimento'])->name('consulta.atendimento');
        Route::get('/concluir/{id}', [ConsultaController::class, 'concluirAtendimento'])->name('consulta.concluir');
        Route::get('/anamnese/{id}', [ConsultaController::class, 'createAnamnese'])->name('consulta.createAnamnese');
        Route::get('/evolucao/{id}', [ConsultaController::class, 'createEvolucao'])->name('consulta.createEvolucao');
        Route::get('/acompanhamento/{id}', [ConsultaController::class, 'createAcompanhamento'])->name('consulta.createAcompanhamento');
        Route::post('/acompanhamento', [ConsultaController::class, 'storeAcompanhamento'])->name('acompanhamento.store');
        Route::post('/anamnese', [ConsultaController::class, 'storeAnamnese'])->name('anamnese.store');
        Route::post('/evolucao', [ConsultaController::class, 'storeEvolucao'])->name('evolucao.store');
        Route::prefix('prontuarios')->group(function () {
            Route::get('/', [ConsultaController::class, 'prontuarios'])->name('consulta.indexProntuarios');
            Route::get('/anamnese/{id}', [ConsultaController::class, 'showAnamnese'])->name('consulta.showAnamnese');
            Route::get('/acompanhamento/{id}', [ConsultaController::class, 'showAcompanhamento'])->name('consulta.showAcompanhamento');
            Route::get('/evolucao/{id}', [ConsultaController::class, 'showEvolucao'])->name('consulta.showEvolucao');
        });
    });
    Route::resource('consulta', ConsultaController::class)->names([
        'index' => 'consulta.index',
        'create' => 'consulta.create',
        'edit' => 'consulta.edit',
        'update' => 'consulta.update',
        'show' => 'consulta.show',
        'store' => 'consulta.store',
        'destroy' => 'consulta.destroy',
    ]);
    Route::resource('avaliacao', AvaliacaoController::class);
});

