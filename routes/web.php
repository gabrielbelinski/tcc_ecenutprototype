<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConsultaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    /* if (auth()->check()) {
        return inertia('Index/Index');
    } */
    //return inertia('Login/Login');
    return inertia('Index/Index');
});
Route::get('/login', function () {
    //return inertia('Login/Login');
    return inertia('Login/Login');
});

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
Route::prefix('consulta/atendimento')->group(function () {
    Route::get('/', [ConsultaController::class, 'atendimento'])->name('consulta.atendimento');
    Route::get('/anamnese/{id}', [ConsultaController::class, 'createAnamnese'])->name('consulta.createAnamnese');
    Route::get('/evolucao/{id}', [ConsultaController::class, 'createEvolucao'])->name('consulta.createEvolucao');
    Route::get('/acompanhamento/{id}', [ConsultaController::class, 'createAcompanhamento'])->name('consulta.createAcompanhamento');
    Route::post('/acompanhamento', [ConsultaController::class, 'storeAcompanhamento'])->name('acompanhamento.store');
    Route::post('/anamnese', [ConsultaController::class, 'storeAnamnese'])->name('anamnese.store');
    Route::post('/evolucao', [ConsultaController::class, 'storeEvolucao'])->name('evolucao.store');
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




