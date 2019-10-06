<?php

namespace App\Http\Controllers\Formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Regras extends Controller
{
    public function ModusPonens($prem_cond,$premissa){
        if($prem_cond->getPremissa()->getValor_obj()->getTipo()=="CONDICIONAL"){
            if($prem_cond->getPremissa()->getValor_obj()->getEsquerdaValor()==$premissa->getPremissa()->getValor_obj()->getValor()){
                if($premissa->getPremissa()->getValor_obj()->getNegado()==$prem_cond->getPremissa()->getValor_obj()->getEsquerda()->getNegado()){
                    return $prem_cond->getPremissa()->getValor_obj()->getDireita();
                }
                
            // só esta pegando aplicando o modus ponens, pensar uma forma de retornar ele e aplicar identificação
            }
        }
    }

    public function  ElimNegacao($premissa){
        if ($premissa->getPremissa()->getValor_obj()->getNegado() >= 2){
            $premissa->getPremissa()->getValor_obj()->eliminacaoNegacao();
            return $premissa; 
            // só esta pegando aplicando eliminação neg, pensar uma forma de retornar ele e aplicar identificação;
        }
    }
    public function IntroducaoConjucao($premissa){
       
        // pensar como passar do index pra ca.
    }
    public function EliminacaoConjucao($premissa){
        // pensar como passar do index pra ca.
    }
    public function IntroducaoDisjuncao($premissa1,$premissa2){
        // pensar como passar do index pra ca.
    }
    public function EliminacaoDisjuncao($premissa){
        // pensar como passar do index pra ca.
    }
    public function IntroducaoBicondicional($premissa1,$premissa2){
        if($premissa1->getEsquerda()->getValor()==$premissa2->getDireita()->getValor()){
            if($premissa1->getEsquerda()->getNegado()==$premissa2->getDireita()->getNegado()){
                if($premissa1->getDireita()->getValor()==$premissa2->getEsquerda()->getValor()){
                    if($premissa1->getDireita()->getNegado()==$premissa2->getEsquerda()->getNegado()){
                        return true;
                    }
                }
            }
          
        }
    }
    public function EliminacaoBicondicional($premissa){

    }


}
