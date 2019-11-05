@extends('base')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-8">
            <!-- Fórmula selecionada -->
            <div class="card bg-white rounded-top-15">
                <div class="card-header bg-gradient-blue text-white rounded-top-15 d-flex justify-content-center negrito m-0">
                        Fórmula
                </div>
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <span>@yield('formula', 'Nenhuma Formula Selecionada')</span>
                    </div>
                </div>
            </div>
            @if ($formula == 'Nenhuma Fórmula Carregada...')
            @else
            <!-- Derivação -->
            <div class="card bg-white">
                <div class="card-body">
                    @yield('derivacao')
                </div>
            </div>
            <!-- Aplicação de regras -->
            <div class="card bg-white rounded-bottom-15">
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
                        <div class="row justify-content-center mt-4">
                            <div class="col-4" >
                                <button type="submit" class="btn btn-block bg-gradient-primary text-white">Aplicar</button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
        <div class="col-4">
            <!-- Envio arquivo -->
            <div class="card bg-white rounded-top-15">
                <div class="card-header bg-gradient-blue text-white rounded-top-15 d-flex justify-content-center negrito m-0">
                        Arquivo XML
                </div>
                <div class="card-body pb-0">
                    <form method="post" action="{{URL::to('/submit')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="custom-file mb-2">
                            <input type="file" class="custom-file-input" name = "arquivo"  accept=".xml" required>
                            <label class="custom-file-label" for="arquivo">Escolha o arquivo</label>
                        </div>
                        <div class="col d-flex justify-content-center mt-2">
                            <div class="row">
                                <button type="submit" class="btn shadow bg-gradient-success rounded-05rem">
                                    <span class="text-white ml-2"><i class="fas fa-cloud-upload-alt text-18"></i></span>
                                    <span class="text-white ml-2 mr-2">Enviar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card bg-white rounded-bottom-15">
                <div class="card-body">
                    <table class="table table-bordered justify-content-center">
                        <tbody>
                            @foreach($listaFormulas as $formula)
                            <tr>
                                <th class="text-center align-middle p-3">{{$formula['xml']}}</th>
                                <td class="text-center align-middle p-2">{{$formula['str']}}</td>
                                <td class="text-center align-middle m-0 p-0">
                                    <form class="m-0" method="post" action="{{URL::to('/Derivacao')}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name='idFormula' value={{$formula['xml']}}>
                                        <button type="submit" class="btn btn-sm shadow bg-gradient-success rounded-05rem">
                                            <span class="text-white">Gerar</span>
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

