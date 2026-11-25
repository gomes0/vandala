
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('forma_pagamento')->nullable();
            $table->string('status_pagamento')->default('pendente');
            $table->string('codigo_rastreamento')->nullable();
            $table->text('observacao_admin')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn([
                'forma_pagamento',
                'status_pagamento',
                'codigo_rastreamento',
                'observacao_admin',
            ]);
        });
    }
};
