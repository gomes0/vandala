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
        Schema::create('item_carrinhos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('carrinho_id')
                ->constrained('carrinhos')
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

            $table->integer('quantidade');

            $table->decimal('preco', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_carrinhos');
    }
};
