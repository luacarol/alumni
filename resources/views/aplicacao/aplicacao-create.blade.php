@extends('base')

@section('headLk')
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{asset('js/aplicacao-questionario.js')}}"></script>
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
                    <div>
                        @if(isset($aplicacao))
                            <h3>Edite uma Aplicação</h3>
                        @else
                            <h3>Cadastre uma Aplicação</h3>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($aplicacao))
                        <form action="{{route('aplicacao.atualizar',$aplicacao->id)}}" method="POST">
                    @else
                        <form action="{{route('aplicacao.salvar')}}" method="POST">
                    @endif                    
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-row">
                            <div class="col-lg-12 mb-3">
                                <label>Questionário</label>
                                <select class="form-control form-control-alternative" id="questionario" name="questionario">
                                    @foreach($questionarios as $questionario)
                                        @if(isset($aplicacao) && $questionario->id == $aplicacao->idQuestionario)
                                            <option value="{{$questionario->id}}" selected="">{{$questionario->titulo}}</option>
                                        @else
                                            <option value="{{$questionario->id}}">{{$questionario->titulo}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6 mb-3">
                                <label>Data Início da Aplicação</label>
                                @if(isset($aplicacao))
                                    <input type="text" name="dataInic" id="dataInic" class="form-control  form-control-alternative" required="" value="{{date('d/m/Y',strtotime($aplicacao->dataInicio))}}" onkeypress="$(this).mask('00/00/0000');">
                                @else
                                    <input type="text" name="dataInic" id="dataInic" class="form-control  form-control-alternative" required="" onkeypress="$(this).mask('00/00/0000');">
                                @endif
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label>Data Fim da Aplicação</label>
                                @if(isset($aplicacao))
                                    <input type="text" name="dataFim" id="dataFim" class="form-control  form-control-alternative" required="" value="{{date('d/m/Y',strtotime($aplicacao->dataFim))}}" onkeypress="$(this).mask('00/00/0000');">
                                @else
                                    <input type="text" name="dataFim" id="dataFim" class="form-control  form-control-alternative" required="" onkeypress="$(this).mask('00/00/0000');">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <p>Turmas</p>
                            @php
                                if(isset($aplicacaoTurmas))
                                {
                                    $ids = array();
                                    foreach($aplicacaoTurmas as $apTr)
                                    {
                                        array_push($ids,$apTr->id);
                                    }
                                }
                            @endphp
                            @foreach($turmas as $turma)
                                <div class="col-12">
                                    @if(isset($aplicacaoTurmas) && in_array($turma->id,(array) $ids))
                                        <input type="checkbox" name="turmas[{{$turma->id}}]" id="turma{{$turma->id}}" class="d-none" checked="">
                                        <label for="turma{{$turma->id}}" class="turmas btn btn-primary btn-block"> {{$turma->nome}}</label>
                                    @else
                                        <input type="checkbox" name="turmas[{{$turma->id}}]" id="turma{{$turma->id}}" class="d-none">
                                        <label for="turma{{$turma->id}}" class="turmas btn btn-light btn-block"> {{$turma->nome}}</label>
                                    @endif
                                </div>
                            @endforeach                           
                        </div>
                        <div class="form-row  justify-content-end">
                            <button class="btn btn-success">Salvar Aplicação</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
