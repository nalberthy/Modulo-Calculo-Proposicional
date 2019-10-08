<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Formula\Argumento;

class Index extends Controller
{
    function __construct() {
        $this->arg = new Argumento;
    }

    public function teste(){
        echo 'teste';
    }
    public function Index(){
        return view('index');
        }


    public function SalvarXml(Request $request){

        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()){

            $diretorio = scandir('C:\xampp\htdocs\calculoproposicional\storage\app\public\formulas');
            $num = count($diretorio) - 1;
            $request->file('arquivo')->storeAs('formulas', 'formula-'.$num.'.xml');

            $xml = simplexml_load_file($request->file('arquivo'));

            $premissas = $this->arg->arrayPremissas($xml);
            $conclusao = $this->arg->arrayConclusao($xml);
            $derivacao =  $this->arg->arrayDerivacao($premissas);
            
            

            $indice=1;
            foreach ($derivacao as $i) {
                $i->setIndice($indice);
                if (in_array($i->getPremissa(), $premissas, true)){
                    $i->setIdentificacao('p');
                }
                else{
                    $i->setIdentificacao('setar aplicação');
                }
                print_r($i->getIndice().'&nbsp &nbsp &nbsp &nbsp'.$this->arg->stringArg($i->getPremissa()->getValor_obj()).'&nbsp &nbsp &nbsp &nbsp'.$i->getIdentificacao()."<br><br>");
                $indice+=1;
            }

            return $this->Index();
        }
    }

    public function Derivacao(Request $request){
 



        

        # Busca XML no diretorio
        return view('derivacao');
        #
    }

    public function Regras(){

        

    }


}
