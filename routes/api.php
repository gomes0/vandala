
<?php

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarrinhoController;
use App\Http\Controllers\Api\EnderecoController;
use App\Http\Controllers\Api\FavoritoController;

// Status da API
Route::get('/status', function () {
    return response()->json([
        'sucesso' => true,
        'mensagem' => 'API VÂNDALA funcionando!',
    ]);
});

// Usuário autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Produtos ativos
Route::get('/produtos', function () {
    return response()->json(
        Produto::with(['categoria', 'imagens'])
            ->where('status', 'ativo')
            ->latest()
            ->get()
    );
});

// Categorias
Route::get('/categorias', function () {
    return response()->json(
        Categoria::withCount([
            'produtos' => function ($query) {
                $query->where('status', 'ativo');
            }
        ])->get()
    );
});

// Autenticação
Route::post('/cadastro', [AuthController::class, 'cadastrar']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usuario', [AuthController::class, 'usuarioAutenticado']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Carrinho
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/carrinho', [CarrinhoController::class, 'index']);
    Route::post('/carrinho/itens', [CarrinhoController::class, 'adicionar']);
    Route::put('/carrinho/itens/{id}', [CarrinhoController::class, 'atualizar']);
    Route::delete('/carrinho/itens/{id}', [CarrinhoController::class, 'remover']);
});

// Favoritos
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/favoritos', [FavoritoController::class, 'index']);
    Route::post('/favoritos/{produto}', [FavoritoController::class, 'store']);
    Route::delete('/favoritos/{produto}', [FavoritoController::class, 'destroy']);
    Route::get('/favoritos/{produto}/verificar', [FavoritoController::class, 'verificar']);
});

// Endereços
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('enderecos', EnderecoController::class);

    Route::patch(
        '/enderecos/{endereco}/principal',
        [EnderecoController::class, 'principal']
    );
});
