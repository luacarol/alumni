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
                        @if(isset($evento))
                            <h3>Edite um Evento</h3>
                        @else
                            <h3>Cadastre um Evento</h3>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($evento))
                        <form action="{{route('evento.atualizar',$evento->id)}}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{route('evento.salvar')}}" method="POST" enctype="multipart/form-data">
                    @endif
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-row">
                            <div class="col-lg-12 mb-3">
                                <label for="">Título</label>
                                @if(isset($evento))
                                    <input type="text" class="form-control form-control-alternative" id="titulo" name="titulo" required="" value="{{$evento->titulo}}">
                                @else
                                    <input type="text" class="form-control form-control-alternative" id="titulo" name="titulo" required="">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4 mb-3">
                                <label for="">Data</label>
                                @if(isset($evento))
                                    <input type="date" class="form-control form-control-alternative datepicker" id="data" name="data" required="" value="{{$evento->data}}">
                                @else
                                    <input type="date" class="form-control form-control-alternative datepicker" id="data" name="data" required="">
                                @endif
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="">Horário de  Início</label>
                                @if(isset($evento))
                                    <input type="time" class="form-control form-control-alternative" id="horarioIn" name="horarioIn" required="" value="{{$evento->horarioIn}}">
                                @else
                                    <input type="time" class="form-control form-control-alternative" id="horarioIn" name="horarioIn" required="">
                                @endif
                            </div>
                            <div class="col-lg-4 mb-3">
                                <label for="">Horário de  Fim</label>
                                @if(isset($evento))
                                    <input type="time" class="form-control form-control-alternative" id="horarioFin" name="horarioFin" required="" value="{{$evento->horarioFin}}">
                                @else
                                    <input type="time" class="form-control form-control-alternative" id="horarioFin" name="horarioFin" required="">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="">Local</label>
                                @if(isset($evento))
                                    <input type="text" class="form-control form-control-alternative" id="local" name="local" value="{{$evento->local}}">
                                @else
                                    <input type="text" class="form-control form-control-alternative" id="local" name="local">
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            @if(!isset($evento))
                                <div class="col-md-5 mb-3 form-group mt-4">
                                    <label for="image" class="btn btn-block btn-info mt-2">Anexar Imagem <i class="fas fa-image ml-2"></i> 
                                        <span id='file-name'></span>
                                    </label>
                                    <input type="file" class="form-control form-control-alternative d-none" id="image" name="image"/>
                                </div>
                            @endif
                            @if(isset($evento))
                            <div class="col-md-6 mb-3">
                                <label for="">Quantidade de vagas</label>
                                    <input type="number" class="form-control form-control-alternative" min="0" id="qtdVagas" name="qtdVagas" value="{{$evento->qtdVagas}}">
                            @else
                            <div class="offset-md-1 col-md-6 mb-3">
                                <label for="">Quantidade de vagas</label>
                                    <input type="number" class="form-control form-control-alternative" min="0" id="qtdVagas" name="qtdVagas">
                            @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 mb-3">
                                <label for="">Descrição</label>
                                <textarea cols="70" rows="7" class="form-control" id="descricao" name="descricao">@if(isset($evento)) {{$evento->descricao}} @endif</textarea>
                            </div>
                        </div>
                         <input type="submit" value="Salvar Evento" class="btn btn-block btn-success col-md-2 offset-md-10" />
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
