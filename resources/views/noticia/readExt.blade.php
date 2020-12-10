@extends('base')

@section('main')
<div class="container-fluid mt--4">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0 row">
                	<h1 class="col-12 text-center">{{$noticia->titulo}}</h1>
                	<h3 class="col-12 text-center">{{$noticia->lide}}</h3>
                </div>
                <div class="card-body">
                	<div class="col-12 mb-5 d-flex justify-content-center">
                		@if($noticia->imagem != '')
                          <img class="img-fluid" src="{{ url("storage/uploadNoticias/{$noticia->imagem}") }}">
                        @endif
					</div>
					<div class="col-12 mt-3">
						@php
	                        echo($noticia->texto);
	                    @endphp
					</div>
					<div class="col-12 text-container mb-5 mt-5">
						<p>Publicado por: {{$noticia->nome}} {{$noticia->sobrenome}}</p>
                        <p>Data de publicação: {{date('d/m/Y',strtotime($noticia->data))}}</p>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

