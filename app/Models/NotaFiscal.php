<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaFiscal extends Model
{
    use HasFactory;

    protected $table = 'nfe';
    protected $fillable = [
        'cnpj_cpf_prestador',
        'nota_valor',
        'nota_impostos',
        'nota_chave',
        'nota_data_recebimento',
        'nota_data_emissao'
    ];
}
