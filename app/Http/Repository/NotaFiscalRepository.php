<?php

namespace App\Http\Repository;

use App\Models\NotaFiscal;

class NotaFiscalRepository {

    private $model;
    public function __construct () {
        $this->model = new NotaFiscal();
    }

    public function salvar(array $data){
        $this->model->fill($data);
        return $this->model->save();
    }

    public function getNotaByChave($chave) {
        return $this->model->newQuery()
            ->where('nota_chave', '=', $chave)
            ->first();
    }
}
