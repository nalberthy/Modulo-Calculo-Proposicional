@extends('index')

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
