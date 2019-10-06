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

            $derivacao =  $this->arg->arrayDerivacao($xml);

            print_r($this->arg->stringFormula($xml));

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
