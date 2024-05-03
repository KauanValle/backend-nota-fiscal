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
        Schema::create('nfe', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj_cpf_prestador', 14);
            $table->double('nota_valor');
            $table->double('nota_impostos');
            $table->string('nota_chave', 44);
            $table->dateTime('nota_data_recebimento');
            $table->dateTime('nota_data_emissao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfe');
    }
};
