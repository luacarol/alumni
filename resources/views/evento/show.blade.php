@extends('base')

@section('main')
<div class="container-fluid mt--4">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0 row">
                	<h1 class="col-12 text-center">{{$evento->titulo}}</h1>
                </div>
                <div class="card-body">
                    @if($evento->imagem != '')
                    	<div class="col-12 mb-5 d-flex justify-content-center">
                            <img class="img-fluid" name="image" src="{{ url("storage/uploadEvetos/{$evento->imagem}") }}">
    					</div>
                    @endif
                    <div class="col-12 mt-3 card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 border-top-0 border-bottom-0 border-left-0 border-right" style="border-style: dashed !important;">
                                    <p><strong>Data: </strong> {{date('d/m/Y',strtotime($evento->data))}}</p>
                                    <p><strong>Das: </strong> {{$evento->horarioIn}} as {{$evento->horarioFin}}</p>
                                </div>
                                <div class="col-md-6 ">
                                    <p class="ml-md-2"><strong>Local: </strong> {{$evento->local}}</p>
                                    <p class="ml-md-2"><strong>Interesse de Egressos: </strong>
                                    @if(isset($interesse))
                                        {{$interesse}}
                                    @else
                                        0
                                    @endif
                                    /{{$evento->qtdVagas}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-12 mt-3">
						@php
	                        echo($evento->descricao);
	                    @endphp
					</div>
					<div class="col-12 text-container mb-5 mt-5">
						<p>Publicado por: {{$evento->nome}} {{$evento->sobrenome}}</p>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

