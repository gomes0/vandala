
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remover as estruturas antigas, que estão vazias.
        Schema::dropIfExists('item_pedidos');
        Schema::dropIfExists('pedido_itens');
        Schema::dropIfExists('pedidos');

        // Estrutura atual dos pedidos.
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('usuario_id')
                ->nullable()
                ->constrained('usuarios')
                ->nullOnDelete();

            $table->string('nome');
            $table->string('email');
            $table->string('cpf', 14);
            $table->string('telefone', 20);

            $table->string('cep', 9);
            $table->string('estado', 2);
            $table->string('cidade');
            $table->string('bairro');
            $table->string('endereco');
            $table->string('numero', 20);
            $table->string('complemento')->nullable();

            $table->decimal('subtotal', 10, 2);
            $table->decimal('frete', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            $table->string('status')->default('pendente');
            $table->string('forma_pagamento')->nullable();
            $table->string('status_pagamento')->default('pendente');

            $table->string('codigo_rastreamento')->nullable();
            $table->text('observacao_admin')->nullable();

            $table->timestamps();
        });

        // Estrutura atual dos itens dos pedidos.
        Schema::create('pedido_itens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                ->constrained('pedidos')
                ->cascadeOnDelete();

            $table->foreignId('produto_id')
                ->nullable()
                ->constrained('produtos')
                ->nullOnDelete();

            $table->string('nome_produto');
            $table->decimal('preco_unitario', 10, 2);
            $table->unsignedInteger('quantidade');
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedido_itens');
        Schema::dropIfExists('pedidos');

        // Restaurar a estrutura antiga de pedidos.
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('usuarios')
                ->cascadeOnDelete();

            $table->decimal('valor_total', 10, 2);

            $table->enum('status', [
                'Pendente',
                'Pago',
                'Enviado',
                'Entregue',
                'Cancelado',
            ])->default('Pendente');

            $table->timestamps();

            $table->string('forma_pagamento')->nullable();
            $table->string('status_pagamento')->default('pendente');
            $table->string('codigo_rastreamento')->nullable();
            $table->text('observacao_admin')->nullable();
        });

        // Restaurar a estrutura antiga dos itens.
        Schema::create('item_pedidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pedido_id')
                ->constrained('pedidos')
                ->cascadeOnDelete();

            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->cascadeOnDelete();

            $table->foreignId('cor_id')
                ->nullable()
                ->constrained('cores')
                ->nullOnDelete();

            $table->foreignId('tamanho_id')
                ->nullable()
                ->constrained('tamanhos')
                ->nullOnDelete();

            $table->unsignedInteger('quantidade');
            $table->decimal('preco', 10, 2);

            $table->timestamps();
        });
    }
};
