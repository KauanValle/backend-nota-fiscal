<?php
namespace App\Validators;

use App\Validators\IValidator;
use Illuminate\Support\Facades\Validator;

class NotaFiscalValidator implements IValidator
{
    public static function validarDados(array $data){
        $arrayValidation = [
            'nota_data_emissao' => 'required|date',
            'nota_data_recebimento' => 'required|date',
            'cnpj_cpf_prestador' => 'required|integer'
        ];

        $arrayValidation += self::verificarNotaChave($data['nota_chave']);

        $validator = Validator::make($data, $arrayValidation);
        if ($validator->fails()){
            return $validator->errors();
        }
    }

    private static function verificarNotaChave($nota_chave){
        // Por conta de uma limitação do PHP, a quantidade de caracteres que é informado no campo de chave como inteiro excede a quantidade de caracteres permitida.
        // Por conta dessa limitação, foi feita essa função para validar manualmente e aplicar a validação correta de acordo com o retorno das validações.
        $notaChaveIsNumeric = is_numeric($nota_chave);
        if (!$notaChaveIsNumeric || !(strlen($nota_chave) == 44)) {
            $validation = 'required|min:44|max:44';
            if(!$notaChaveIsNumeric) {
                $validation .= '|integer';
            }
            return ['nota_chave' => $validation];
        }
        return [];
    }
}
