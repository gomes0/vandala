<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();

        $table->foreignId('usuario_id')
            ->nullable()
            ->constrained('usuarios')
            ->nullOnDelete();

        // Dados do cliente
        $table->string('nome');
        $table->string('email');
        $table->string('cpf', 14);
        $table->string('telefone', 20);

        // Endereço de entrega
        $table->string('cep', 9);
        $table->string('estado', 2);
        $table->string('cidade');
        $table->string('bairro');
        $table->string('endereco');
        $table->string('numero', 20);
        $table->string('complemento')->nullable();

        // Valores e situação
        $table->decimal('subtotal', 10, 2);
        $table->decimal('frete', 10, 2)->default(0);
        $table->decimal('total', 10, 2);
        $table->string('status')->default('pendente');

        $table->timestamps();
    });
}
};
