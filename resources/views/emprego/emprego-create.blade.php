@extends('base')

@section('headLk')
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
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
                        @if(isset($emprego))
                            <h3>Edite uma Vaga de Emprego</h3>
                        @else
                            <h3>Insire uma Vaga de Emprego</h3>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($emprego))
                        <form action="{{route('emprego.atualizar',$emprego->id)}}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{route('emprego.salvar')}}" method="POST" action="redimensionarImagem.php" enctype="multipart/form-data">
                    @endif
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-row">
                            <div class="col-lg-12 mb-3">
                                <label for="">Nome da Vaga</label>
                                @if(isset($emprego))
                                    <input type="text" class="form-control form-control-alternative" id="nomeVaga" name="nomeVaga" required="" value="{{$emprego->nomeVaga}}">
                                @else
                                    <input type="text" class="form-control form-control-alternative" id="nomeVaga" name="nomeVaga" required="">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4 mb-3">
                                <label for="">Salário</label>
                                @if(isset($emprego))
                                    <input type="text" class="form-control form-control-alternative datepicker" id="salario" name="salario" required="" value="{{$emprego->salario}}">
                                @else
                                    <input type="text" class="form-control form-control-alternative datepicker" id="salario" name="salario" required="">
                                @endif
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="">Pré-Requisitos</label>
                                @if(isset($emprego))
                                    <input type="text" class="form-control form-control-alternative" id="preRequisitos" name="preRequisitos" required="" value="{{$emprego->preRequisitos}}">
                                @else
                                    <input type="text" class="form-control form-control-alternative" id="preRequisitos" name="preRequisitos" required="">
                                @endif
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="">Atividades da Vaga</label>
                                @if(isset($emprego))
                                    <input type="text" class="form-control form-control-alternative" id="atividadeVaga" name="atividadeVaga" required="" value="{{$emprego->atividadeVaga}}">
                                @else
                                    <input type="text" class="form-control form-control-alternative" id="atividadeVaga" name="atividadeVaga" required="">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6 mb-3">
                                <label for="">Local</label>
                                @if(isset($emprego))
                                    <input type="text" class="form-control form-control-alternative" id="local" name="local" value="{{$emprego->local}}">
                                @else
                                    <input type="text" class="form-control form-control-alternative" id="local" name="local">
                                @endif
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Horário</label>
                                @if(isset($emprego))
                                    <input type="text" class="form-control form-control-alternative" id="horario" name="horario" value="{{$emprego->horario}}">
                                @else
                                    <input type="text" class="form-control form-control-alternative" id="horario" name="horario">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="">Data de Publicação</label>
                                @if(isset($emprego))
                                    <input type="date" class="form-control form-control-alternative" id="dataPublicacao" name="dataPublicacao" value="{{$emprego->dataPublicacao}}">
                                @else
                                    <input type="date" class="form-control form-control-alternative" id="dataPublicacao" name="dataPublicacao">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            @if(!isset($emprego))
                                <div class="col-md-5 mb-3 form-group mt-4">
                                    <label for="image" class="btn btn-block btn-info mt-2">Anexar Imagem <i class="fas fa-image ml-2"></i>
                                        <span id='file-name'></span>
                                    </label>
                                    <input type="file" class="form-control form-control-alternative d-none" id="image" name="image"/>
                                </div>
                            @endif
                            @if(isset($emprego))
                            <div class="col-md-6 mb-3">
                                <label for="">Quantidade de vagas</label>
                                    <input type="number" class="form-control form-control-alternative" min="0" id="qtdVagas" name="qtdVagas" value="{{$emprego->qtdVagas}}">
                            @else
                            <div class="offset-md-1 col-md-6 mb-3">
                                <label for="">Quantidade de vagas</label>
                                    <input type="number" class="form-control form-control-alternative" min="0" id="qtdVagas" name="qtdVagas">
                            @endif
                            </div>
                        </div>
                        <!--
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="">Descrição</label>
                                <textarea cols="70" rows="7" class="form-control" id="descricao" name="descricao">@if(isset($evento)) {{$evento->descricao}} @endif</textarea>
                            </div>
                        </div>
                        -->
                         <input type="submit" value="Salvar" class="btn btn-block btn-success col-md-2 offset-md-10" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var $input    = document.getElementById('image'),
        $fileName = document.getElementById('file-name');

        $input.addEventListener('change', function(){
            $fileName.textContent = this.value;
        });
    </script>
@endsection
