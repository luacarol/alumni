@extends('base')
@section('content')
<div class="p-4">

    <div class="card">
        <div class="col-12 pt-2">
            @if(session()->get('success'))
                <div class="alert alert-dismissible alert-success">
                  {{ session()->get('success') }}  
                </div>
            @endif
            @if(session()->get('erro'))
                <div class="alert alert-dismissible alert-danger">
                  {{ session()->get('erro') }}  
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-dismissible alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div>
                @if(isset($aluno))
                    <h3>Edite um aluno</h3>
                @else
                    <h3>Cadastre um novo aluno</h3>
                @endif
            </div>
        </div>
        <div class="p-5">
            @if(isset($aluno))
                <form action="{{route('egresso.atualizar',$aluno->cpf)}}" method="POST" >
            @else
                <form action="{{route('egresso.salvar')}}" method="POST" >
            @endif
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-row">
                    <div class="col-lg-12 mb-3">
                        <label for="">Nome</label>
                        @if(isset($aluno))
                            <input type="text" class="form-control" id="nome" name="nome" required="" value="{{$aluno->nome}}">
                        @else
                            <input type="text" class="form-control" id="nome" name="nome" required="" >
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-6 mb-3">
                        <label for="">CPF</label>
                        @if(isset($aluno))
                            <input type="text" class="form-control"  id="cpf" name="cpf" onkeypress="$(this).mask('000.000.000-00');" required="" value="{{$aluno->cpf}}">
                        @else
                            <input type="text" class="form-control"  id="cpf" name="cpf" onkeypress="$(this).mask('000.000.000-00');" required="">
                        @endif
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="">Prontuário</label>
                        @if(isset($aluno))
                            <input type="text" class="form-control" id="prontuario" name="prontuario" required=""maxlength="9" value="{{$matricula->prontuario}}">
                        @else
                            <input type="text" class="form-control" id="prontuario" name="prontuario" required=""maxlength="9">
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-6 mb-3">
                        <label for="genero">Gênero</label>
                        <select class="form-control" name="genero" id="genero">
                            @foreach($generos as $genero)
                                <option value="{{$genero->id}}">{{$genero->genero}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="curso">Curso</label>
                        <select class="form-control" name="curso" id="curso">
                            @foreach($cursos as $curso)
                                <option value="{{$curso->idCurso}}">{{$curso->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <input type="submit" value="Salvar Aluno" class="btn btn-block btn-success col-md-2 offset-md-10" />
                </div>
            
            </form>
        </div>

    </div>

</div>
@endsection
