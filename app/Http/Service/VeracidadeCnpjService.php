<?php

namespace App\Http\Service;

use App\Enum\VeracidadeCnpjEnum;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class VeracidadeCnpjService {
    private $cnpj;

    public function verificarVeracidadeCnpj($cnpj) {
        $this->cnpj = $cnpj;
        return $this->chamarMicroServico();
    }

    private function chamarMicroServico(){
        // Dentro do método montarUrl() ele pega a URL direto do .env
        return Http::withHeaders($this->headers())
            ->post($this->montarUrl() ,
                $this->payload())['isValid'];
    }

    private function payload(){
        return [
            "cnpj" => $this->cnpj
        ];
    }

    private function headers(){
        return [
            "Content-Type" => "application/json",
            "authorization-token-service" => env("AUTHORIZATION_API_TOKEN")
        ];
    }

    private function montarUrl(){
        return env('API_URL_VERACIDADE') . VeracidadeCnpjEnum::URL_VALIDAR;
    }
}
