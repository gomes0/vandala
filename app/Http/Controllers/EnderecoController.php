<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnderecoController extends Controller
{
    // Lista os endereços do usuário
    public function index(Request $request)
    {
        $enderecos = $request->user()
            ->enderecos()
            ->orderByDesc('principal')
            ->latest()
            ->get();

        return view('enderecos.index', compact('enderecos'));
    }

    // Exibe o formulário de cadastro
    public function create()
    {
        return view('enderecos.create');
    }

    // Salva um novo endereço
    public function store(Request $request)
    {
        $dados = $this->validarEndereco($request);

        $usuario = $request->user();

        DB::transaction(function () use ($usuario, $dados) {
            $dados['principal'] = $dados['principal']
                || !$usuario->enderecos()->exists();

            if ($dados['principal']) {
                $usuario->enderecos()->update([
                    'principal' => false,
                ]);
            }

            $usuario->enderecos()->create($dados);
        });

        return redirect()
            ->route('enderecos.index')
            ->with('success', 'Endereço cadastrado com sucesso!');
    }

    // Exibe o formulário de edição
    public function edit(Request $request, int $id)
    {
        $endereco = $request->user()
            ->enderecos()
            ->findOrFail($id);

        return view('enderecos.edit', compact('endereco'));
    }

    // Atualiza um endereço
    public function update(Request $request, int $id)
    {
        $endereco = $request->user()
            ->enderecos()
            ->findOrFail($id);

        $dados = $this->validarEndereco($request);

        DB::transaction(function () use ($request, $endereco, $dados) {
            if ($dados['principal']) {
                $request->user()
                    ->enderecos()
                    ->where('id', '!=', $endereco->id)
                    ->update(['principal' => false]);
            }

            $endereco->update($dados);
        });

        return redirect()
            ->route('enderecos.index')
            ->with('success', 'Endereço atualizado com sucesso!');
    }

    // Exclui um endereço
    public function destroy(Request $request, int $id)
    {
        $usuario = $request->user();

        $endereco = $usuario->enderecos()->findOrFail($id);

        DB::transaction(function () use ($usuario, $endereco) {
            $eraPrincipal = $endereco->principal;

            $endereco->delete();

            if ($eraPrincipal) {
                $proximo = $usuario->enderecos()->first();

                if ($proximo) {
                    $proximo->update(['principal' => true]);
                }
            }
        });

        return redirect()
            ->route('enderecos.index')
            ->with('success', 'Endereço excluído com sucesso!');
    }

    // Define um endereço como principal
    public function principal(Request $request, int $id)
    {
        $usuario = $request->user();

        $endereco = $usuario->enderecos()->findOrFail($id);

        DB::transaction(function () use ($usuario, $endereco) {
            $usuario->enderecos()->update([
                'principal' => false,
            ]);

            $endereco->update([
                'principal' => true,
            ]);
        });

        return redirect()
            ->route('enderecos.index')
            ->with('success', 'Endereço principal atualizado!');
    }

    // Validação dos dados
    private function validarEndereco(Request $request): array
    {
        return $request->validate([
            'nome_destinatario' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:20',
            'cep' => 'required|string|max:9',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:30',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|size:2',
            'principal' => 'nullable|boolean',
        ]) + [
            'principal' => $request->boolean('principal'),
        ];
    }
}
