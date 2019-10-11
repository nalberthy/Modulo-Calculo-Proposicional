<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Formula\Argumento;
use App\Http\Controllers\Construcao;
use App\Http\Controllers\Formula\Regras;

class Index extends Controller
{
    function __construct() {
        $this->arg = new Argumento;
        $this->constr = new Construcao;
        $this->regra= new Regras;
        
    }

    public function Index(){
        $listaFormulas=$this->constr->stringXmlDiretorio();
        return view('index',['listaFormulas'=> $listaFormulas, 'formulaGerada'=> 'Nenhuma Fórmula Carregada...' , 'idXml'=>'','listaDerivacoes'=>'']);

        }


    public function SalvarXml(Request $request){
        
        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()){
            $dir=dirname(__FILE__,4.).'\storage\app\public\formulas';
            $diretorio = scandir($dir);
            $num = count($diretorio) - 1;
            $request->file('arquivo')->storeAs('formulas', 'formula-'.$num.'.xml');
            return $this->Index();
        }
    }

    public function Derivacao(Request $request){
        # Busca XML no diretorio
        $id = $request->all()['idFormula'];
        $dir=dirname(__FILE__,4.).'\storage\app\public\formulas';
        #Pega xml passado na requisição
        $xml = simplexml_load_file($dir.'\formula-'.$id.'.xml');

        #Gera arrays
        $premissas = $this->arg->arrayPremissas($xml);
        $conclusao = $this->arg->arrayConclusao($xml);
        $derivacao =  $this->arg->arrayDerivacao($premissas);
        
        #etapas usuario
        
        $listaDerivacoes = '{}';

        #gera formula para exibição
        $formula=$this->arg->formula($premissas,$conclusao);
        # array de objeto derivações
        $derivacoes=$this->constr->gerar($derivacao,$premissas);
        # formulas disponiveis para aplicação
        $listaFormulas=$this->constr->stringXmlDiretorio();


        return view('derivacao',['derivacoes'=>$derivacoes,'listaFormulas'=> $listaFormulas, 'formula'=>$formula, 'idXml'=>$id, 'listaDerivacoes'=>$listaDerivacoes ]);
        
    }




    public function Derivar(Request $request){
        $id = $request->all()['idXml'];

        $formulario = $request->all();
        $dir=dirname(__FILE__,4.).'\storage\app\public\formulas';
        $xml = simplexml_load_file($dir.'\formula-'.$formulario['idXml'].'.xml');
        
        #arrays 
        $premissas = $this->arg->arrayPremissas($xml);
        $conclusao = $this->arg->arrayConclusao($xml);
        $derivacao =  $this->arg->arrayDerivacao($premissas);

        #gera lista de obj etapa inicial
        

        #-------transforma o json em array----
        $listaDerivacoes=$formulario['derivacoes'];
        $listaDerivacoes=json_decode($listaDerivacoes,true);
        #-------------------------------------
        
        #-------- Reconstrói primeira etapa de derivação visual---------
        $derivacoes=$this->constr->gerar($derivacao,$premissas);
        #--------------------------------------------------------
        #-------- Reconstró passo a passo -----------------------
        $derivacaoPasso= $this->constr->gerarPasso($derivacao,$listaDerivacoes);
        
        
        #--------------------------------------------------------
        

        #Deriva a tentativa atual, caso erro retorna valor boleano 
        $derivacaofinal=$this->constr->aplicarRegra($derivacaoPasso,$formulario['linha1'],$formulario['linha2'],$formulario['regra']);


        if($derivacaofinal==False){
            $derivacoes=$this->constr->gerar($derivacaoPasso,$premissas);
            $formula=$this->arg->formula($premissas,$conclusao);
            $listaFormulas=$this->constr->stringXmlDiretorio();
            $listaDerivacoes =json_encode ($listaDerivacoes);
        }
        else{
            $derivacoes=$this->constr->gerar($derivacaofinal,$premissas);
            $formula=$this->arg->formula($premissas,$conclusao);
            $listaFormulas=$this->constr->stringXmlDiretorio();
            array_push( $listaDerivacoes, ['linha1'=>$formulario['linha1'],'linha2'=>$formulario['linha2'],'regra'=>$formulario['regra']]);
            $listaDerivacoes =json_encode ($listaDerivacoes);
        }
    
        return view('derivacao',['derivacoes'=>$derivacoes,'listaFormulas'=> $listaFormulas, 'formula'=>$formula, 'idXml'=>$id, 'listaDerivacoes'=> $listaDerivacoes]);
           
    }


}
