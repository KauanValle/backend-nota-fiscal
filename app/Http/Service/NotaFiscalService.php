<?php
namespace App\Http\Service;

use App\Http\Service\VeracidadeCnpjService;
use App\Exceptions\NotaFiscalErroException;
use App\Http\Repository\NotaFiscalRepository;

class NotaFiscalService {
    private $repository;
    public function __construct(){
        $this->repository = new NotaFiscalRepository();
    }
    public function salvarNfe(array $data) {
        if($this->verificarCnpj($data['cnpj_cpf_prestador'])){
            return $this->salvarNfeNoBanco($data);
        }
        throw new NotaFiscalErroException(json_encode("O CNPJ informado não é igual ao da MadeiraMadeira."), 401);
    }

    public function buscarNotaPelaChave(string $chave){
        return $this->repository->getNotaByChave($chave);
    }

    private function verificarCnpj($cnpj){
        $veracidadeCnpjService = new VeracidadeCnpjService();
        return $veracidadeCnpjService->verificarVeracidadeCnpj($cnpj);
    }

    private function salvarNfeNoBanco(array $data){
        return $this->repository->salvar($data);
    }
}
