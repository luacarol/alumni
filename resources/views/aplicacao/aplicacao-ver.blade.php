@extends('base')

@section('main')
<div class="container-fluid mt--4">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0 row">
                	<h1 class="col-12 text-center">Questionário: {{$aplicacao->titulo}}</h1>
                </div>
                <div class="card-body">
					<div class="col-12 mb-5 mt-5">
						<p>Data de início: {{$aplicacao->dataInicio}}</p>
                        <p>Data de finalização: {{$aplicacao->dataFim}}</p>
					</div>
                    <div class="col-12 mb-5 mt-5">
                        <h3>Turmas de aplicação: </h3>
                        @foreach($turmas as $turma)
                            <p>{{$turma->nome}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

