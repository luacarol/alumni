@extends('base')

@section('main')
<div class="container-fluid mt--4">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0 row">
                	<h1 class="col-12 text-center">{{$emprego->nomeVaga}}</h1>
                </div>
                <div class="card-body">
                    @if($emprego->imagem != '')
                    	<div class="col-12 mb-5 d-flex justify-content-center">
                            <img width="50%" class="img-fluid" name="image" src="{{ url("storage/uploadEmpregos/{$emprego->imagem}") }}">
    					</div>
                    @endif
                    <div class="col-12 mt-3 card shadow">
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 border-top-0 border-bottom-0 border-left-0 border-right" style="border-style: dashed !important;">
                                        <p><strong>Pre-Requisitos: </strong> {{$emprego->preRequisitos}}</p>
                                    </div>
                                    <div class="col-md-6 ">
                                        <p class="ml-md-2"><strong>Atividades da Vaga: </strong> {{$emprego->atividadeVaga}}</p>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 border-top-0 border-bottom-0 border-left-0 border-right" style="border-style: dashed !important;">
                                    <p><strong>Local: </strong> {{$emprego->local}}</p>
                                    <p><strong>Horário: </strong> {{$emprego->horario}}</p>
                                </div>
                                <div class="col-md-6 ">
                                    <p class="ml-md-2"><strong>Data de Publicação: </strong> {{date('d/m/Y',strtotime($emprego->dataPublicacao))}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

