<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoImagemController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColecaoController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\ProfileController;


// =====================================================
// PÁGINAS PÚBLICAS
// =====================================================

// Página inicial
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Sobre
Route::view('/sobre', 'sobre.index')
    ->name('sobre');

// Contato
Route::view('/contato', 'contato.index')
    ->name('contato');


// =====================================================
// LOJA E PRODUTOS
// =====================================================

// Loja
Route::get('/loja', [LojaController::class, 'index'])
    ->name('loja.index');

// Coleções
Route::get('/colecoes', [ColecaoController::class, 'index'])
    ->name('colecoes.index');

// Detalhes do produto
Route::get('/produto/{produto}', [ProdutoController::class, 'show'])
    ->name('produto.show');


// =====================================================
// CARRINHO E CHECKOUT
// =====================================================

// Carrinho
Route::get('/carrinho', [CarrinhoController::class, 'index'])
    ->name('carrinho.index');

Route::post('/carrinho/adicionar/{produto}', [CarrinhoController::class, 'adicionar'])
    ->name('carrinho.adicionar');

Route::post('/carrinho/remover/{produto}', [CarrinhoController::class, 'remover'])
    ->name('carrinho.remover');

Route::post('/carrinho/aumentar/{produto}', [CarrinhoController::class, 'aumentar'])
    ->name('carrinho.aumentar');

Route::post('/carrinho/diminuir/{produto}', [CarrinhoController::class, 'diminuir'])
    ->name('carrinho.diminuir');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');


// =====================================================
// ÁREA DO CLIENTE (USUÁRIO AUTENTICADO)
// =====================================================

Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // Favoritos
    Route::get('/favoritos', [FavoritoController::class, 'index'])
        ->name('favoritos.index');

    Route::post('/favoritos/{produto}', [FavoritoController::class, 'store'])
        ->name('favoritos.store');

    Route::delete('/favoritos/{produto}', [FavoritoController::class, 'destroy'])
        ->name('favoritos.destroy');

});


// =====================================================
// PAINEL ADMINISTRATIVO
// =====================================================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        // Categorias
        Route::resource('categorias', CategoriaController::class);


        // Produtos
        Route::resource('produtos', ProdutoController::class);


        // Imagens dos produtos
        Route::get('/produtos/{produto}/imagens', [ProdutoImagemController::class, 'index'])
            ->name('produto-imagens.index');

        Route::post('/produtos/{produto}/imagens', [ProdutoImagemController::class, 'store'])
            ->name('produto-imagens.store');

        Route::delete('/produto-imagens/{imagem}', [ProdutoImagemController::class, 'destroy'])
            ->name('produto-imagens.destroy');

        Route::put('/produto-imagens/{imagem}/principal', [ProdutoImagemController::class, 'principal'])
            ->name('produto-imagens.principal');


        // Pedidos
        Route::resource('pedidos', PedidoController::class);

    });
// =====================================================
// AUTENTICAÇÃO
// =====================================================

require __DIR__ . '/auth.php';