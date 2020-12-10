@extends('base')
@section('headerPg')
    <a class="btn btn-primary btn-sm text-white" href="{{route('mensagem.index')}}"><i class="fas fa-chevron-left"></i> Voltar</a>
@endsection
@section('main')
<div class="container-fluid mt--4">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0 row">
                	<h1 class="col-12 text-center">{{$mensagem->assunto}}</h1>
                	<h4 class="col-12 text-center">Enviado por: <a href="mailto:{{$mensagem->email}}">{{$mensagem->nome}}</a> em {{date('d/m/Y',strtotime($mensagem->data))}}</h4>
                    <h5 class="text-center col-12">Telefone de contato: {{$mensagem->telefone}}</h5>
                    <h5 class="text-center col-12">Email de contato: <a href="mailto:{{$mensagem->email}}">{{$mensagem->email}}</a></h5>
                </div>
                <div class="card-body">
					<div class="col-12">
						<p class="text-justify">{{$mensagem->mensagem}}</p>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

