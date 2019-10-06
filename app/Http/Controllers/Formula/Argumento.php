<?php

namespace App\Http\Controllers\Formula;

use Illuminate\Http\Request;
use App\Model\Formula\Predicado;
use App\Model\Formula\Conclusao;
use App\Model\Formula\Premissa;
use App\Model\Formula\Derivacao;
use App\Http\Controllers\Controller;

class Argumento extends Controller
{
     private function childrenIsLpred ($pai){
        return $pai->children()->getName()=="LPRED" ? true : false;
    }

    private function encontraFilho($pai){
        $nome = $pai->children()->getName();
        if ($nome =="CONDICIONAL"){
            return $this->condicional($pai->children());
        }
        elseif($nome =="BICONDICIONAL"){
            return $this->bicondicional($pai->children());
        }
        elseif ($nome =="DISJUNCAO"){
            return $this->disjuncao($pai->children());
        }
        elseif($nome =="CONJUNCAO"){
            return $this->conjuncao($pai->children());
        }  
    }

    public function qntdNegacao($artribudto){
        return strlen($artribudto);
    }

    private function lpred($lpred){
        $negacao=$lpred->attributes()["NEG"];
        return ['NEG'=>$this->qntdNegacao($negacao), 'PREDICATIVO'=>$lpred->children()->__toString()];
    }

    private function condicional($condicional){
        $antecendente_xml =$condicional->children()[0];
        $consequente_xml = $condicional->children()[1];
        
        
        if ($this->childrenIsLpred($antecendente_xml)){
       
            $antecendente_array = $this->lpred($antecendente_xml->children());
            $antecendente_no = new Predicado($antecendente_array['PREDICATIVO'],$antecendente_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $antecendente_no = $this->encontraFilho($antecendente_xml);
           
        }
        if ($this->childrenIsLpred($consequente_xml)){
            $consequente_array = $this->lpred($consequente_xml->children());
            $consequente_no = new Predicado($consequente_array['PREDICATIVO'],$consequente_array['NEG'],'PREDICATIVO',null,null);
       

        }
        else{
            $consequente_no = $this->encontraFilho($consequente_xml);
           

        }
        $valor = $antecendente_no->getValor()."→".$consequente_no->getValor();
        return new Predicado($valor,$this->qntdNegacao($condicional->attributes()["NEG"]),'CONDICIONAL',$antecendente_no,$consequente_no);
    }

    private function bicondicional($bicondicional){
        $primario_xml = $bicondicional->children()[0];
        $secundario_xml = $bicondicional->children()[1];
        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new Predicado($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null);
    
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml);
        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new Predicado($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);
        }
        $valor = $primario_no->getValor()."↔".$secundario_no->getValor();
        return new Predicado($valor,$this->qntdNegacao($bicondicional->attributes()["NEG"]),'BICONDICIONAL',$primario_no,$secundario_no);
    }

    private function disjuncao($disjuncao){
        $primario_xml = $disjuncao->children()[0];
        $secundario_xml = $disjuncao->children()[1];

        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new Predicado($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml);
           
        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new Predicado($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);
        

        }
        $valor = $primario_no->getValor()."^".$secundario_no->getValor();
        return new Predicado($valor,$this->qntdNegacao($disjuncao->attributes()["NEG"]),'DISJUNCAO',$primario_no,$secundario_no);


    }
 
    private function conjuncao($conjuncao){
        $primario_xml = $conjuncao->children()[0];
        $secundario_xml = $conjuncao->children()[1];

        if ($this->childrenIsLpred($primario_xml)){
            $primario_array = $this->lpred($primario_xml->children());
            $primario_no = new Predicado($primario_array['PREDICATIVO'],$primario_array['NEG'],'PREDICATIVO',null,null);
        }
        else{
            $primario_no = $this->encontraFilho($primario_xml); 

        }
        if ($this->childrenIsLpred($secundario_xml)){
            $secundario_array = $this->lpred($secundario_xml->children());
            $secundario_no = new Predicado($secundario_array['PREDICATIVO'],$secundario_array['NEG'],'PREDICATIVO',null,null);

        }
        else{
            $secundario_no = $this->encontraFilho($secundario_xml);

        }
        $valor = $primario_no->getValor()."^". $secundario_no->getValor();
        return new Predicado($valor,$this->qntdNegacao($conjuncao->attributes()["NEG"]),'CONJUNCAO',$primario_no,$secundario_no);
    }

    
    public function premissa($premissa){
        if ($premissa->getName()=="PREMISSA"){
            if($this->childrenIsLpred($premissa)){
                $premissa_array = $this->lpred($premissa->children());
                $valor_no = new Predicado ($premissa_array['PREDICATIVO'],$premissa_array['NEG'],'PREMISSA',null,null);
              
                return new Premissa($valor_no->getValor(), $valor_no);
            }
            else{
                $nome = $premissa->children()->getName();
                if($nome=="CONDICIONAL"){
                    
                    $valor = $this->condicional($premissa->children());
                }
                elseif($nome=="BICONDICIONAL"){
                    $valor = $this->bicondicional($premissa->children());
                }
                elseif($nome=="DISJUNCAO"){
                    $valor = $this->disjuncao($premissa->children());
                }
                elseif($nome=="CONJUNCAO"){
                    $valor = $this->conjuncao($premissa->children());
                }
            }
            return new Premissa($valor->getValor(), $valor);
        }
        return false;
    }

    public function conclusao($conclusao){
        if ($conclusao->getName()=="CONCLUSAO"){
            if($this->childrenIsLpred($conclusao)){
                $conclusao_array = $this->lpred($conclusao->children());
                $valor_no = new Predicado($conclusao_array['PREDICATIVO'],$conclusao_array['NEG'],'CONCLUSAO',null,null);
                return new Conclusao($valor_no->getValor(),"|- ", $valor_no);
            }
            else{
                $nome = $conclusao->children()->getName(); 

                if($nome=="CONDICIONAL"){

                    $valor = $this->condicional($conclusao->children());
                }
                elseif($nome=="BICONDICIONAL"){
                    $valor = $this->bicondicional($conclusao->children());
                }
                elseif($nome=="DISJUNCAO"){
                    $valor = $this->disjuncao($conclusao->children());
                   
                }
                elseif($nome=="CONJUNCAO"){
                    $valor = $this->conjuncao($conclusao->children());
                }
            }
            return new Conclusao($valor->getValor(),"|- ",$valor);;

        }
        return false;

    }


    public function derivacao($premissa){
            return new Derivacao(null,$premissa,null);
    }
    public function newpremissa($predicado){
        return new Premissa($predicado->getValor(), $predicado);
    }
    public function newconjuncao($predicado1,$predicado2){
        $valor = $predicado1->getValor()."^". $predicado2->getValor();
        return new Predicado($valor,0,'CONJUNCAO',$predicado1,$predicado2);
    }
    public function newdisjuncao($predicado1,$predicado2){
        $valor = $predicado1->getValor()."v". $predicado2->getValor();
        return new Predicado ($valor,0,'DISJUNCAO',$predicado1,$predicado2);
    }
    public function newbicondicional($predicado1,$predicado2){
        $valor = $predicado1->getValor()."↔". $predicado2->getValor();
        return new Predicado ($valor,0,'BICONDICIONAL',$predicado1,$predicado2);
    }
    public function newcondicional($predicado1,$predicado2){
        $valor = $predicado1->getValor()."→". $predicado2->getValor();
        return new Predicado ($valor,0,'CONDICIONAL',$predicado1,$predicado2);
    }
}


// Metodos de criação:

function criarPremissa($predicado){
    $arg = new Argumento;
    return $arg->newpremissa($predicado);
    }
function criarDerivacao($premissa){
    $arg = new Argumento;
    return $arg-> derivacao($premissa);
}
function criarConjuncao($predicado1,$predicado2){
    $arg = new Argumento;
    return $arg->newconjuncao($predicado1,$predicado2);
}
function criarDisjuncao($predicado1,$predicado2){
    $arg = new Argumento;
    return $arg->newdisjuncao($predicado1,$predicado2);
}
function criarBicondicional($predicado1,$predicado2){
    $arg = new Argumento;
    return $arg->newbicondicional($predicado1,$predicado2);
}
function criarCondicional($predicado1,$predicado2){
    $arg = new Argumento;
    return $arg->newcondicional($predicado1,$predicado2);
}


// Geração de arrays
function arrayDerivacao($xml){
    $arg = new Argumento;
    $arrayDerivacao=[];
    $premissas = arrayPremissas($xml);
    foreach ($premissas as $premissa){
        array_push($arrayDerivacao, $arg->derivacao($premissa));
    }
    return $arrayDerivacao;   
    }

function arrayPremissas($xml){
    $arg = new Argumento;
    $arrayPremissas=[];
    
    foreach ($xml as $filhos){
        if ($filhos->getName()=='PREMISSA'){
            array_push($arrayPremissas, $arg->premissa($filhos));
        }
    }
    return $arrayPremissas;    
}

function arrayConclusao($xml){
    $arg = new Argumento;
    $arrayConclusao=[];
    foreach ($xml as $filhos){
        if ($filhos->getName()=='CONCLUSAO'){
            array_push($arrayConclusao, $arg->conclusao($filhos));
        }
    }
    return  $arrayConclusao;
}


function stringFormula($argumento){
    // print_r($argumento);
    // echo '<br>.<br>';
    if (in_array($argumento->getTipo(), ['CONJUNCAO','BICONDICIONAL','CONDICIONAL', 'DISJUNCAO'])){
        $negacao='';
        $string=null;
        if ($argumento->getNegado()>0){
            for($i = 0 ; $i < $argumento->getNegado(); $i++){
                $negacao="~ ".$negacao;
            }
        }
        switch ($argumento->getTipo()) {
            case 'CONJUNCAO':
                $string = $negacao.'('.stringArg($argumento->getEsquerda()).' ^ '.stringArg($argumento->getDireita()).')';
                break;
            case 'BICONDICIONAL':
                $string = $negacao.'('.stringArg($argumento->getEsquerda()).' ↔ '.stringArg($argumento->getDireita()).')';
                break;
            case 'CONDICIONAL':
                $string = $negacao.'('.stringArg($argumento->getEsquerda()).' → '.stringArg($argumento->getDireita()).')';
                break;
            case 'DISJUNCAO':
                $string =$negacao.'('.stringArg($argumento->getEsquerda()).' v '.stringArg($argumento->getDireita()).')';
                break;
        }
        return $string;
    }
    else{
        $negacao='';
        if ($argumento->getNegado()>0){
            for($i = 0 ; $i < $argumento->getNegado(); $i++){
                $negacao="~ ".$negacao;
            }
        }
        $string= $negacao.' '.$argumento->getValor();
        return $string;
    }
}


