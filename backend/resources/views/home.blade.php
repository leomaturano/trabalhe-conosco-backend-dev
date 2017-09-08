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
                        <input type="text" class="form-control" placeholder="Nome ou Username" aria-describedby="basic-addon1"
                               id="campoPesquisa">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="btnPesquisar">
                                Pesquisar
                            </button>
                        </span>
                    </div>
                    <table class="table table-striped"> 
                        <thead> 
                            <tr> 
                                <th>Chave</th> 
                                <th>Nome</th> 
                                <th>Id</th> 
                            </tr> 
                        </thead> 
                        <tbody id="tableUsers"> 
                            <tr class="ocultar" id="linhaModelo"> 
                                <td name="id">id</td> 
                                <td name="name"></td> 
                                <td name="username"></td> 
                            </tr> 
                        </tbody> 
                    </table>
                    <nav aria-label="mudar paginas">
                        <ul class="pagination" id="listaPaginas">
                            <span id="listaPaginasSpan"></span>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
