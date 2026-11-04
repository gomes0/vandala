<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            if (!Schema::hasColumn('enderecos', 'nome_destinatario')) {
                $table->string('nome_destinatario')->nullable();
            }

            if (!Schema::hasColumn('enderecos', 'telefone')) {
                $table->string('telefone', 20)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropColumn([
                'nome_destinatario',
                'telefone',
            ]);
        });
    }
};