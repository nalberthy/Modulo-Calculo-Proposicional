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

        if ($regra == 'Modus_Ponens'){
            if ($derivacoes[$linha1]->getPremissa()->getValor_obj()->getTipo()=="CONDICIONAL"){
                if($derivacoes[$linha1]->getPremissa()->getValor_obj()->getEsquerdaValor()==$derivacoes[$linha2]->getPremissa()->getValor_obj()->getValor()){
                    $aplicado= $this->reg->ModusPonens($derivacoes,$derivacoes[$linha1],$derivacoes[$linha2]);
                    $aplicado->setIdentificacao(($linha1+1).','.($linha2+1).' mp');
                    array_push($derivacoes,$aplicado);
                    return $derivacoes;
                   
                }
            }
        
            elseif ($derivacoes[$linha2]->getPremissa()->getValor_obj()->getTipo()=="CONDICIONAL"){
                if($derivacoes[$linha2]->getPremissa()->getValor_obj()->getEsquerdaValor()==$derivacoes[$linha1]->getPremissa()->getValor_obj()->getValor()){
                    $aplicado=$this->reg->ModusPonens($derivacoes,$derivacoes[$linha1],$derivacoes[$linha2]); 
                    $aplicado->setIdentificacao(($linha2+1).','.($linha1+1).' mp');
                    array_push($derivacoes,$aplicado);
                    return $derivacoes;
                }

            }
            else{
                return False;
            }

        }
        elseif($regra=='Introducao_Disjuncao'){
            $aplicado=$this->reg->IntroducaoDisjuncao($derivacoes,$derivacoes[$linha1],$derivacoes[$linha2]);
            
            $aplicado->setIdentificacao(($linha1+1).','.($linha2+1).' vI');
            array_push($derivacoes,$aplicado);
            return $derivacoes;
        }
        elseif($regra=='Eliminacao_Disjuncao'){
            // Disponibilizado em breve
        }
        elseif($regra=='Introducao_Conjuncao'){
            $aplicado=$this->reg->IntroducaoConjuncao($derivacoes,$derivacoes[$linha1],$derivacoes[$linha2]);
            $aplicado->setIdentificacao(($linha1+1).','.($linha2+1).' ^I');

            array_push($derivacoes,$aplicado);
            return $derivacoes;
        }

        elseif($regra=='Eliminacao_Conjuncao'){
            $derivacoes= $this->reg->EliminacaoConjuncao($derivacoes,$derivacoes[$linha1],$linha1);
            return $derivacoes;
        }
        elseif($regra=='Eliminacao_Negacao'){
            $derivacoes=$this->reg->ElimicacaoNegacao($derivacoes,$derivacoes[$linha1],$linha1);
            return $derivacoes;
        }
        elseif($regra=='Introducao_Bicondicional'){
            if($derivacoes[$linha1]->getPremissa()->getValor_obj()->getTipo()=='CONDICIONAL' and $derivacoes[$linha2]->getPremissa()->getValor_obj()->getTipo()=='CONDICIONAL'){
                $aplicado=$this->reg->IntroducaoBicondicional($derivacoes,$derivacoes[$linha1],$derivacoes[$linha2]);

                $aplicado->setIdentificacao(($linha1+1).','.($linha2+1).' ↔I');
                array_push($derivacoes,$aplicado);
                return $derivacoes;
            }
            return FALSE;
            
        }
        elseif($regra=='Eliminacao_Bicondicional'){
            $derivacoes= $this->reg->EliminacaoBicondicional($derivacoes,$derivacoes[$linha1],$linha1);
            return $derivacoes;
        }
        elseif($regra=='PC'){
             // Disponibilizado em breve
        }
        elseif($regra=='Raa'){
            // Disponibilizado em breve
       }
    }

    #reconstrói objeto a partir de array com regras aplicadas anteriormente 
    public function gerarPasso($derivacao,$passo){
        if($passo!=[]){
            foreach ($passo as $i) {
                $derivacao= $this->aplicarRegra($derivacao,$i['linha1'],$i['linha2'],$i['regra']);
            }
            return $derivacao;
        }
        else{
            return $derivacao;
        }
        
    }  
    

    public function verificaConclusao($conclusao,$derivacao){

        foreach ($derivacao as $i){
            if($this->arg->stringArg($conclusao[0]->getValor_obj())==$this->arg->stringArg($i->getPremissa()->getValor_obj())){
                return TRUE;
            }
        }
        
    }
    
}
