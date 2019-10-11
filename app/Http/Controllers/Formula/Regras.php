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
                    return $this->arg->derivacao($this->arg->criarPremissa($newpremissa1->getDireita()));
                }
            }
        }
        elseif($newpremissa2->getTipo()=="CONDICIONAL"){
            if($newpremissa2->getEsquerdaValor()==$newpremissa1->getValor()){
                if($newpremissa1->getNegado()==$newpremissa2->getEsquerda()->getNegado()){
                    return $this->arg->derivacao($this->arg->criarPremissa($newpremissa2->getDireita()));
                }
            }
        }
    }

    public function IntroducaoDisjuncao($derivacao,$premissa1,$premissa2){
        $newpremissa1 = clone $premissa1->getPremissa()->getValor_obj();
        $newpremissa2 = clone $premissa2->getPremissa()->getValor_obj();

        return $this->arg->derivacao($this->arg->criarpremissa($this->arg->criardisjuncao($newpremissa1,$newpremissa2)));
    }

    function IntroducaoConjuncao($derivacao,$premissa1,$premissa2){
        $newpremissa1 = clone $premissa1->getPremissa()->getValor_obj();
        $newpremissa2 = clone $premissa2->getPremissa()->getValor_obj();
        
        return $this->arg->derivacao($this->arg->criarpremissa($this->arg->criarconjuncao($newpremissa1,$newpremissa2)));
    }

    function EliminacaoConjuncao($derivacao,$premissa,$linha){
        $newpremissa= clone $premissa->getPremissa()->getValor_obj();
        $newpremissa1= $this->arg->derivacao($this->arg->criarpremissa($newpremissa->getEsquerda()));
        $newpremissa1->setIdentificacao(($linha+1).' ^E');

        $newpremissa2=$this->arg->derivacao($this->arg->criarpremissa($newpremissa->getDireita()));
        $newpremissa2->setIdentificacao(($linha+1).' ^E');

        array_push($derivacao,$newpremissa1);
        array_push($derivacao,$newpremissa2);
        return $derivacao;
    }

    function ElimicacaoNegacao($derivacao,$premissa,$linha){
        $newpredicado = clone $premissa->getPremissa()->getValor_obj();
        if ($newpredicado->getNegado() >= 2){
            $newpredicado->eliminacaoNegacao();
        }
        $newpredicado=$this->arg->derivacao($this->arg->criarpremissa($newpredicado));
        $newpredicado->setIdentificacao(($linha+1).' ~E');
        
        array_push($derivacao,$newpredicado);

        return $derivacao;

    }


}
