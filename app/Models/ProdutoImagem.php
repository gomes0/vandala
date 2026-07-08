<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdutoImagem extends Model
{
    protected $table = 'produto_imagens';

    protected $fillable = [

        'produto_id',

        'caminho',

        'nome_original',

        'principal',

        'ordem'

    ];

    protected $casts = [

        'principal' => 'boolean'

    ];

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
