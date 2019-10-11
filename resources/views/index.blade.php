@extends('base')



@section('content')
<!-- Envio arquivo -->

<div  class="content-fluid " style="margin-top: 20px;">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                        <form method="post" action="{{URL::to('/submit')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                            <button type="submit" class="btn btn-outline-dark">Enviar</button>
                                    <div class="custom-file">
                                    <input type="file" name = "arquivo"  accept=".xml" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Arquivo XML</label>
                                </div>
                            </div>
                           
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div  class="content-fluid " style="margin-top: 20px;">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    @yield('formula', 'Nenhuma Formula Selecionada')
                </div>
            </div>
        </div>
    </div>
</div>
           
<div  class="content-fluid " style="margin-top: 20px;">
    <div class="row">
        <div class="col-8">
            <div class="card">
               <div class="card-body">
                    @yield('derivacao')
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{URL::to('/Derivar')}}">
                        {{ csrf_field() }}
                        
                        <div class="row">
                                <input type="hidden" class="form-control" name='idXml' value={{$idXml}} aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                <input type="hidden"  name='derivacoes' value={{$listaDerivacoes}} class="form-control">
                            <div class="col-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="valor1">Valor1</span>
                                    </div>
                                    <input type="text" class="form-control" name='linha1' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="valor2">Valor2</span>
                                    </div>
                                    <input type="text" class="form-control" name='linha2' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>        
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="mp1" value="Modus_Ponens" name="regra" class="custom-control-input">
                                    <label class="custom-control-label" for="mp1">Modus Ponens</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="id1" value="Introducao_Disjuncao"name="regra" class="custom-control-input">
                                    <label class="custom-control-label" for="id1">Introdução da Disjunção</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="ed1" value='Eliminacao_Disjuncao' name="regra" class="custom-control-input" disabled>
                                    <label class="custom-control-label" for="ed1">Eliminação da Disjunção</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="ic1" value= 'Introducao_Conjuncao' name="regra" class="custom-control-input">
                                    <label class="custom-control-label" for="ic1">Introdução da Conjunção</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="ec1" value='Eliminacao_Conjuncao' name="regra" class="custom-control-input">
                                    <label class="custom-control-label" for="ec1">Eliminação da Conjunção</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="en1" value='Eliminacao_Negacao' name="regra" class="custom-control-input">
                                    <label class="custom-control-label" for="en1">Eliminação da Negação</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="ib1" value='Introducao_Bicondicional' name="regra" class="custom-control-input">
                                    <label class="custom-control-label" for="ib1">Introdução Bicondicional</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="eb1" value='Eliminacao_Bicondicional' name="regra" class="custom-control-input">
                                    <label class="custom-control-label" for="eb1">Eliminação Bicondicional</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="pc1" value='PC' name="regra" class="custom-control-input" disabled>
                                    <label class="custom-control-label" for="pc1">Prova do Condicional</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="raa1" value='Raa' name="regra" class="custom-control-input" disabled>
                                    <label class="custom-control-label" for="raa1">Redução ao Absurdo</label>
                                </div>
                            </div>
                            </div>
                        <div class="row justify-content-center">
                            <div class="col-4" >
                                <button type="submit" class="btn btn-outline-dark">Aplicar</button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                        <table class="table table-bordered">
                                <tbody>
                                    @foreach($listaFormulas as $formula)
                                    <tr>
                                        <th class="text-center align-middle m-0" scope="row">{{$formula['xml']}}</th>
                                        <td class="text-center align-middle" width="60%">{{$formula['str']}}</td>
                                        <td class="text-center align-middle m-0 p-0">
                                            <form method="post" action="{{URL::to('/Derivacao')}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name='idFormula' value={{$formula['xml']}}>
                                                <button type="submit" class="btn btn-sm shadow bg-gradient-green rounded-05rem">
                                                    <span class="text-black">Aplicar</span>
                                                    <span class="text-white ml-2"><i class="fas fa-arrow-right text-18"></i></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection

