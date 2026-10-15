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
    Schema::create('pedido_itens', function (Blueprint $table) {
        $table->id();

        $table->foreignId('pedido_id')
            ->constrained('pedidos')
            ->cascadeOnDelete();

        $table->foreignId('produto_id')
            ->nullable()
            ->constrained('produtos')
            ->nullOnDelete();

        // Cópia dos dados no momento da compra
        $table->string('nome_produto');
        $table->decimal('preco_unitario', 10, 2);
        $table->unsignedInteger('quantidade');
        $table->decimal('subtotal', 10, 2);

        $table->timestamps();
    });
}
};
