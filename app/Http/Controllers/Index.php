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
            return $this->Index();
        }
    }

    public function Derivacao(){
        # Busca XML no diretorio
        $id = $request->all()['idFormula'];
        $xml = simplexml_load_file('C:\xampp\htdocs\calculoproposicional\storage\app\public\formulas\formula-'.$id.'.xml');

        #
    }

    public function Regras(){

    }


}
