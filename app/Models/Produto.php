<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [

        'nome',

        'descricao',

        'preco',

        'estoque',

        'imagem',

        'categoria_id',

        'status'

    ];

    public function usuariosFavoritaram(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favoritos', 'produto_id', 'user_id')
            ->withTimestamps();
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function imagens()
    {
        return $this->hasMany(ProdutoImagem::class);
    }
}
