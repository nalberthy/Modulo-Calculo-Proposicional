@extends('base')

@section('content')
<!-- Envio arquivo -->

<div  class="content-fluid " style="margin-top: 20px;">
    <div class="row">
        <div class="col">
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
    <div class="row">
        <div class="col-6">
            <div class="card">
               <div class="card-body">
                    @yield('derivacao')
                </div>
            </div>
        </div>
        <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{URL::to('/Derivar')}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="mp1" value="Modus_Ponens" name="regra" class="custom-control-input">
                                            <label class="custom-control-label" for="mp1">Modus Ponens</label>
                                        </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="id1" value="Introdução_Disjuncao"name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="id1">Introdução da Disjunção</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="ed1" name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="ed1">Eliminação da Disjunção</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="ic1" name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="ic1">Introdução da Conjunção</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="ec1" name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="ec1">Eliminação da Conjunção</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="en1" name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="en1">Eliminação da Negação</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="ib1" name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="ib1">Introdução Bicondicional</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="eb1" name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="eb1">Eliminação Bicondicional</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="pc1" name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="pc1">Prova do Condicional</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="raa1" name="regra" class="custom-control-input">
                                        <label class="custom-control-label" for="raa1">Redução ao Absurdo</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-dark">Aplicar</button>

                        </form>








                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

