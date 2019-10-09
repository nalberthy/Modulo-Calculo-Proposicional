<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Formula\Argumento;
use App\Http\Controllers\Formula\Regras;

class Construcao extends Controller
{
    function __construct() {
        $this->arg = new Argumento;
        $this->reg = new Regras;
    }
    public function stringXmlDiretorio(){
        $dir=dirname(__FILE__,4.).'\storage\app\public\formulas';
           $diretorio = scandir($dir);
           $num = count($diretorio) - 2;
           $listaFormulas=[];
           for($i=1; $i <= $num ; $i++){
                $xml = simplexml_load_file($dir.'\formula-'.$i.'.xml');
                $premissas = $this->arg->arrayPremissas($xml);
                $conclusao = $this->arg->arrayConclusao($xml);
                $formula = [
                   'str'=>$this->arg->formula($premissas,$conclusao),
                   'xml'=>$i
                ];
               array_push($listaFormulas,$formula);
           }
           return $listaFormulas;
       }

    public function gerar($derivacao,$premissas){
        $derivacoes=[];
        $indice=1;
        foreach ($derivacao as $i) {
            $i->setIndice($indice);
            if (in_array($i->getPremissa(), $premissas, true)){
                $i->setIdentificacao('p');
            }

            $derivacoes[]= ['indice'=>$indice,'str'=>$this->arg->stringArg($i->getPremissa()->getValor_obj()),'ident'=>$i->getIdentificacao()];
            $indice+=1;
        }
        return $derivacoes;
    }   
    public function aplicarRegra($derivacoes,$linha1,$linha2,$regra){
        $linha1=$linha1-1;
        $linha2=$linha2-1;
        // Modus_Ponens
        // Introducao_Disjuncao
        // Eliminacao_Disjuncao
        // Introducao_Conjucao
        // Eliminacao_Negacao
        // Introducao_Bicondicional
        // Eliminacao_Bicondicional
        // PC
        // Raa
        // print_r($derivacoes[$linha1]->getPremissa()->getValor_obj()->getTipo());
        if ($regra == 'Modus_Ponens'){
            if ($derivacoes[$linha1]->getPremissa()->getValor_obj()->getTipo()=="CONDICIONAL"){
                if($derivacoes[$linha1]->getPremissa()->getValor_obj()->getEsquerdaValor()==$derivacoes[$linha2]->getPremissa()->getValor_obj()->getValor()){
                   array_push($derivacoes,$this->reg->ModusPonens($derivacoes,$derivacoes[$linha1],$derivacoes[$linha2])); 
                
                }
            }

        }
        elseif($regra=='Introducao_Disjuncao'){
            
        }
        elseif($regra=='Eliminacao_Disjuncao'){
            
        }
        elseif($regra=='Introducao_Conjucao'){
            
        }
        elseif($regra=='Eliminacao_Negacao'){
            
        }
        elseif($regra=='Introducao_Bicondicional'){
            
        }
        elseif($regra=='Eliminacao_Bicondicional'){
            
        }
        elseif($regra=='PC'){
            
        }

    
    }
    
}