@extends('base')

@section('main')
<div class="container-fluid mt--4">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    @if(session()->get('success'))
                        <div class="alert alert-dismissible alert-success col-12">
                          {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->get('erro'))
                        <div class="alert alert-dismissible alert-danger col-12">
                          {{ session()->get('erro') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-dismissible alert-danger col-12">
                          <ul>
                              @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($questionarios->count() > 0)
                            @foreach($questionarios as $questionario)
                                <div class="col-12">
                                    <div class="card border-0 shadow mb-5">
                                        <div class="card-body">
                                            <div>
                                                <h3>{{$questionario->titulo}}</h3>
                                            </div>

                                            <p>
                                                @php
                                                    echo($questionario->descricao);
                                                @endphp
                                            </p>

                                            <a href="{{route('questionario.ver',[$questionario->id,$questionario->aplicacao])}}" class="btn btn-primary float-right">Responder Questionário</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">Nenhum questionário disponível para resposta</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

