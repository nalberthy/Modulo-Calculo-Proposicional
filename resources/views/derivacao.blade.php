@extends('index')


@if($msg == 'True')
  <div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Parabéns!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Chegou a Conclusão !
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn shadow btn-sm  {{--bg-gradient-blue--}}bg-gradient-blue rounded-05rem "  data-dismiss="modal">
                            <span class="text-white text-center ml-2"><i class="fas fa-play text-18"></i></span>
                           
                            <span class="text-white  text-center ">Encerrar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- {{--        baixar localmente--}} -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="assets/plugins/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#meuModal').modal('show');
        })
    </script>
    
@endif
@if($msg == 'False')
  <div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Revise seus passos e insira os dados corretamente!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Não foi possivel aplicar a regra !
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn shadow btn-sm  {{--bg-gradient-blue--}}bg-gradient-blue rounded-05rem "  data-dismiss="modal">
                            <span class="text-white text-center ml-2"><i class="fas fa-play text-18"></i></span>
                           
                            <span class="text-white  text-center ">Fechar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{--        baixar localmente--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#meuModal').modal('show');
        })
    </script>
    
@endif

@section('formula')
<div class="col d-flex justify-content-center">
    <div class="row badge-custom bg-pink d-flex align-items-center justify-content-center rounded-05rem">
        <span class="text-pink">{{$formula}}</span>
    </div>
</div>
@endsection

@section('derivacao')



<table class="table table-bordered">
    <tbody>
        @foreach($derivacoes as $derivacao)
        <tr>
            <th class="text-center align-middle m-0" scope="row">{{$derivacao['indice']}}</th>
            <td class="text-center align-middle" width="60%">{{$derivacao['str']}}</td>
            <td class="text-center align-middle "> {{$derivacao['ident']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection

@section('formulas')

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


@endsection
