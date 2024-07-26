<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetoController;
use App\Models\Projeto;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProjetoController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projetos', ProjetoController::class);
    Route::get('/publicados', [ProjetoController::class, 'publicados']);
    Route::patch('projetos/{id}/atribuir', [ProjetoController::class, 'atribuir'])->name('projetos.atribuir');
});

require __DIR__.'/auth.php';
