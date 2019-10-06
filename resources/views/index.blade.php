@extends('base')

@section('content')
<!-- Envio arquivo -->
<div class="row justify-content-center">
    <div class="col-6 col-md-5" >
        <div class="container-fluid">
            <div class="card" style="margin-top: 20px;">
                <h5 class='text-center'>Arquivo xml</h5>
                <div class="card-body">
                    <form method="post" action="{{URL::to('/submit')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name = "arquivo"  accept=".xml">
                            <button type="submit" class="btn btn-outline-dark">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="container-fluid">
                <div class="card" style="margin-top: 20px; baxc; background-color: #F5FFFA;">
                    <div class="card-body">
                        @yield('col-8')
                        <div>  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 



@endsection

