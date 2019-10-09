<?php

namespace App\Http\Controllers\Formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Formula\Argumento;


class Regras extends Controller
{
    function __construct() {
        $this->arg = new Argumento;
    }

    public function ModusPonens($derivacao,$premissa1,$premissa2){
        $newpremissa1 = clone $premissa1->getPremissa()->getValor_obj();
        $newpremissa2 = clone $premissa2->getPremissa()->getValor_obj();

        if($newpremissa1->getTipo()=="CONDICIONAL"){
            if($newpremissa1->getEsquerdaValor()==$newpremissa2->getValor()){
                if($newpremissa2->getNegado()==$newpremissa1->getEsquerda()->getNegado()){
                    array_push($derivacao,$this->arg->derivacao($this->arg->criarPremissa($newpremissa1->getDireita())));
                }
            }
        }
        return $derivacao;
    }
}
