
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nome_destinatario');
            $table->string('telefone', 20);
            $table->string('cep', 9);
            $table->string('estado', 2);
            $table->string('cidade');
            $table->string('bairro');
            $table->string('logradouro');
            $table->string('numero', 20);
            $table->string('complemento')->nullable();
            $table->boolean('principal')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
