@extends('index')


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
