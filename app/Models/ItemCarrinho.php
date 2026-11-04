<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemCarrinho extends Model
{
    protected $table = 'item_carrinhos';

    protected $fillable = [
        'carrinho_id',
        'produto_id',
        'cor_id',
        'tamanho_id',
        'quantidade',
        'preco',
    ];

    public function carrinho(): BelongsTo
    {
        return $this->belongsTo(Carrinho::class, 'carrinho_id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}