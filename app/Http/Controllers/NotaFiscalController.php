<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\NotaFiscalService;
use App\Validators\NotaFiscalValidator;
use App\Exceptions\NotaFiscalErroException;

class NotaFiscalController extends Controller
{
    private $service;
    public function __construct() {
        $this->service = new NotaFiscalService();
    }

    public function salvarNotaFiscal(Request $request){
        // Teste de chave inválida: NACSAD2222ADSHCG2W232323232323ASADSSASSSASD2
        // Teste de chave válida: 38921657136821895164871231768222223532453411

        $dadosValidados = NotaFiscalValidator::validarDados($request->all());
        if(!empty($dadosValidados)){
            throw new NotaFiscalErroException($dadosValidados, 401);
        }

        $notaSalva = $this->service->salvarNfe($request->all());
        if($notaSalva){
             return response()->json($this->retorno("NFe salva com sucesso!"), 201);
        }

        throw new NotaFiscalErroException(json_encode("Algo deu problema... Contate o administrador."), 401);
    }

    public function pegarNotaFiscal(string $chave){
        $nota = $this->service->buscarNotaPelaChave($chave);
        if(!$nota){
           throw new NotaFiscalErroException(json_encode("A chave informada não representa nenhuma NFe. Informe uma chave válida."), 401);
        }

        return response()->json($this->retorno($nota), 200);
    }

    private function retorno($mensagem){
        return [
            'success' => true,
            'data' => [
                'message' => $mensagem
            ]
        ];
    }
}
