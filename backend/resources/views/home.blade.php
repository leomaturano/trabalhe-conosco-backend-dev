@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-0">
            <div class="panel panel-default">

                <div class="panel-heading">Consulta de Usuarios</div>

                <div class="panel-body">
                   
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                    </div>

                    <nav aria-label="mudar paginas">
                        <ul class="pager">
                            <li><a href="#">Anterior</a></li>
                            <li><a href="#">Próxima</a></li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
