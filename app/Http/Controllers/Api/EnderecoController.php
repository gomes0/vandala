<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnderecoController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->enderecos()
                ->orderByDesc('principal')
                ->orderByDesc('created_at')
                ->get()
        );
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_destinatario' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'cep' => 'required|string|max:9',
            'estado' => 'required|string|size:2',
            'cidade' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'principal' => 'sometimes|boolean',
        ]);

        $user = $request->user();

        return DB::transaction(function () use ($dados, $user) {
            $principal = ($dados['principal'] ?? false)
                || !$user->enderecos()->exists();

            if ($principal) {
                $user->enderecos()->update(['principal' => false]);
            }

            $dados['principal'] = $principal;

            $endereco = $user->enderecos()->create($dados);

            return response()->json([
                'message' => 'Endereço cadastrado com sucesso.',
                'endereco' => $endereco,
            ], 201);
        });
    }

    public function show(Request $request, Endereco $endereco)
    {
        abort_unless(
            $endereco->user_id === $request->user()->id,
            404
        );

        return response()->json($endereco);
    }

    public function update(Request $request, Endereco $endereco)
    {
        abort_unless(
            $endereco->user_id === $request->user()->id,
            404
        );

        $dados = $request->validate([
            'nome_destinatario' => 'sometimes|required|string|max:255',
            'telefone' => 'sometimes|required|string|max:20',
            'cep' => 'sometimes|required|string|max:9',
            'estado' => 'sometimes|required|string|size:2',
            'cidade' => 'sometimes|required|string|max:255',
            'bairro' => 'sometimes|required|string|max:255',
            'rua' => 'sometimes|required|string|max:255',
            'numero' => 'sometimes|required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'principal' => 'sometimes|boolean',
        ]);

        return DB::transaction(function () use ($dados, $endereco, $request) {
            if (($dados['principal'] ?? false) === true) {
                $request->user()->enderecos()
                    ->where('id', '!=', $endereco->id)
                    ->update(['principal' => false]);
            }

            $endereco->update($dados);

            return response()->json([
                'message' => 'Endereço atualizado com sucesso.',
                'endereco' => $endereco->fresh(),
            ]);
        });
    }

   public function destroy(Request $request, Endereco $endereco)
{
    abort_unless(
        $endereco->user_id === $request->user()->id,
        404
    );

    return DB::transaction(function () use ($endereco, $request) {
        $eraPrincipal = $endereco->principal;
        $user = $request->user();

        DB::table('enderecos')
            ->where('id', $endereco->id)
            ->where('user_id', $user->id)
            ->delete();

        if ($eraPrincipal) {
            $novoPrincipal = $user->enderecos()
                ->orderBy('id')
                ->first();

            if ($novoPrincipal) {
                $novoPrincipal->update([
                    'principal' => true
                ]);
            }
        }

        return response()->json([
            'message' => 'Endereço removido com sucesso.',
        ]);
    });
}

    public function principal(Request $request, Endereco $endereco)
    {
        abort_unless(
            $endereco->user_id === $request->user()->id,
            404
        );

        return DB::transaction(function () use ($endereco, $request) {
            $request->user()->enderecos()
                ->update(['principal' => false]);

            $endereco->update(['principal' => true]);

            return response()->json([
                'message' => 'Endereço principal atualizado.',
                'endereco' => $endereco->fresh(),
            ]);
        });
    }
}
