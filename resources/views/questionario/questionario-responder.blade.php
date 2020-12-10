@extends('base')

@section('headLk')
    <script src="{{asset('js/responder-questionario.js')}}"></script>
@endsection

@section('main')
<div class="container-fluid mt--4">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0 row">
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
                    <h3 class="text-center">{{$questionario->titulo}}</h3>
                    <p class="text-justify">{{$questionario->descricao}}</p>
                </div>
                <div class="card-body pl-md-6 pr-md-6">
                    <form method="POST" id="questionario" action="{{route('questionario.responder',$questionario->id)}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="aplicacao" value="{{$aplicacao}}">
                        @foreach($perguntas as $pergunta)
                            <p>{{$pergunta->pergunta}}</p>
                            @if($pergunta->tipo == 'A')
                                <div class="form-row ">
                                    @foreach($pergunta->alternativas()->get() as $alternativa)
                                        <div class="form-group col-md-6">
                                            <label id="labelalt{{$alternativa->id}}" for="alt{{$alternativa->id}}" class="btn btn-light btn-block pb-3 pt-3 alternativas{{$pergunta->id}}" onclick="responder('alternativas{{$pergunta->id}}','labelalt{{$alternativa->id}}');" >{{$alternativa->alternativa}}</label>
                                            <input type="radio" name="alternativas{{$pergunta->id}}" id="alt{{$alternativa->id}}" class="d-none" value="{{$alternativa->id}}">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="form-group ">
                                    <textarea class="form-control-alternative form-control" name="dissertativas[{{$pergunta->id}}]"></textarea>
                                </div>
                            @endif
                        @endforeach
                        <div class="form-row justify-content-end">
                            <a class="btn btn-success text-white" onclick="finalizar()">Salvar Respostas</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
  
@endsection