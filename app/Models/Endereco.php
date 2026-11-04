<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endereco extends Model
{
    protected $fillable = [
        'user_id',
        'nome_destinatario',
        'telefone',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'rua',
        'numero',
        'complemento',
        'principal',
    ];

    protected function casts(): array
    {
        return [
            'principal' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}