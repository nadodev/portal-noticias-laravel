<?php

use App\Http\Controllers\AssociadosController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DistribuicaoPontosController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\UsuarioController;

// Route::get('/', function () {
//     return view('admin.layouts.app');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Sistema de Pontos
Route::get('/rank', [PointsController::class, 'showProfessionalRanking'])->name('rank');
Route::get('/pontos', [PointsController::class, 'mostrarFormulario'])->name('pontos.index');
Route::post('/pontos', [PointsController::class, 'distribuirPontos'])->name('pontos.store');
// Route::get('/pontos/{id}', [DistribuicaoPontosController::class, 'mostrarProfissionalEPontos']);

// Profissionais
Route::get('/profissionais/site', [ProfissionalController::class, 'index'])->name('profissional.index');
// Route::get('/profissionais/{id}/{nome_profissional}', [ProfissionalController::class, 'show'])->name('profissional.details');
Route::get('/profissionais/pontos', [ProfissionalController::class, 'ShowPointsProfissionais'])->name('profissional.points');
Route::get('/profissionais/{id}/pontos', [ProfissionalController::class, 'pontosRecebidosProfissional'])->name('pontos.recebidos');
Route::get('/lista-ponto-profissionais', [ProfissionalController::class, 'listaPontosPorAssociado'])->name('profissional.lista-pontos');


// Associados
Route::get('/associados', [AssociadosController::class, 'listarAssociados'])->name('associados.index');
Route::get('/associados/{id}/extrato', [AssociadosController::class, 'extratoPontos'])->name('extrato');
Route::get('/extrato-pontos-filtrado/{id}', [AssociadosController::class, 'extratoPontosFiltrado'])->name('extrato.pontos.filtrado');



// Cadastrar
Route::get('cadastro', [RegisteredUserController::class, 'create'])
->name('register');
Route::post('cadastro', [RegisteredUserController::class, 'store']);


Route::post('/agrupar-pontos', [DistribuicaoPontosController::class, 'agruparPontos'])->name('agrupar.pontos');
require __DIR__.'/auth.php';
