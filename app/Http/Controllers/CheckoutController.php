<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);

        if (empty($carrinho)) {
            return redirect()
                ->route('carrinho.index')
                ->with('erro', 'Seu carrinho está vazio.');
        }

        $total = 0;

        foreach ($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        return view('checkout.index', compact(
            'carrinho',
            'total'
        ));
    }
}