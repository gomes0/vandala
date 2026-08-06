<?php

use App\Http\Controllers\ProdutoImagemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;

// Loja
// Route::get('/', function () {
//     return view('home.index');})->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

//admin routes

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('categorias', CategoriaController::class);

        // Produtos
        Route::resource('produtos', ProdutoController::class);

        Route::get(
            'produtos/{produto}/imagens',
            [ProdutoImagemController::class, 'index']
        )->name('produto-imagens.index');

        Route::post(
            'produtos/{produto}/imagens',
            [ProdutoImagemController::class, 'store']
        )->name('produto-imagens.store');

        Route::delete(
            'produto-imagens/{imagem}',
            [ProdutoImagemController::class, 'destroy']
        )->name('produto-imagens.destroy');

        Route::put(
            'produto-imagens/{imagem}/principal',
            [ProdutoImagemController::class, 'principal']
        )->name('produto-imagens.principal');
    });

// Painel
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('/categorias', CategoriaController::class);

    Route::resource('/produtos', ProdutoController::class);

    Route::resource('/pedidos', PedidoController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/sobre', function () {
    return view('sobre.index');
})->name('sobre');




require __DIR__ . '/auth.php';
