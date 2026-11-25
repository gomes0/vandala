<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'usuario_id',

        // Dados do cliente
        'nome',
        'email',
        'cpf',
        'telefone',

        // Endereço
        'cep',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'numero',
        'complemento',

        // Valores
        'subtotal',
        'frete',
        'total',

        // Pagamento e status
        'status',
        'forma_pagamento',
        'status_pagamento',

        // Administração
        'codigo_rastreamento',
        'observacao_admin',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function itens()
    {
        return $this->hasMany(ItemPedido::class, 'pedido_id');
    }
}
