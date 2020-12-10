@extends('base')

@section('headLk')
    <link rel="stylesheet" type="text/css" href="{{asset('css/flutuante.css')}}">
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
                    @if(session()->get('warning'))
                        <div class="alert alert-dismissible alert-warning col-12">
                          {{ session()->get('warning') }}  
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
                    <h3>Finalizar Questionário</h3>
                </div>
                <div class="card-body pl-md-6 pr-md-6">
                    <h1 class="mb-3">{{$questionario->titulo}}</h1>
                    <p class="mb-4 text-justify">{{$questionario->descricao}}</p>
                    <form method="POST" action="{{route('pergunta.salvar',$questionario->id)}}">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div id="formulario">
                            
                        </div>
                        <div class="form-group">
                            <button type="submit" id="salvar" name="salvar" class="btn btn-success float-right mt-5"> Salvar Perguntas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fab">
    <button type="button" id="add-alternativa" class="btn btn-success ml-md-2 mb-2 " data-toggle="tooltip" data-placement="left" title="Adicionar pergunta do tipo alternativa"> <i class="fas fa-check-circle"></i></button><br>
    <button type="button" id="add-campo" class="btn btn-success ml-md-2 mb-2" data-toggle="tooltip" data-placement="left" title="Adicionar pergunta do tipo dissertativa"> <i class="fas fa-font"></i></button>  
</div>
@endsection

@section('script')
    <script>
        var cont = 1;

        var alt = 1;
        
        $('#add-campo').click(function () {
            
            $('#formulario').append('<hr style="border-style: dashed;"><div class="form-group form-row campo' + cont + '" id=""><input type="text" name="dissertativa[]" placeholder="Nova pergunta" class="form-control form-control-alternative col-10 ml-2" required=""> <button type="button" id="' + cont + '" class="btn btn-danger ml-2 btn-apagar"> <i class="fas fa-minus"></i> </button></div>');

            cont++;
        });

        $('#add-alternativa').click(function () {
            
            $('#formulario').append('<hr style="border-style: dashed;"><div class="campo' + cont + '" id="campo' + cont + '"><div class="form-group form-row"><input type="text" name="alternativa[]" placeholder="Nova pergunta" class="form-control form-control-alternative col-10 ml-2">  <input type="hidden"  name="idAlt[]" value="' + cont + '" required=""><button type="button" id="' + cont + '" class="btn btn-danger ml-2 btn-apagar"> <i class="fas fa-minus"></i> </button></div><a class="text-info add-opcao" id="' + cont + '">Adicionar alternativa <i class="fas fa-plus"></i></a></div>');

            cont++;
        });

        $('form').on('click', '.btn-apagar', function () {
            var button_id = $(this).attr("id");
            var elements = document.getElementsByClassName('campo' + button_id + '');

            while (elements.length > 0) {
                elements[0].remove();
            }
    
        });

        $('form').on('click', '.btn-apagar-alt', function () {
            var button_id = $(this).attr("id");
            var element = document.getElementById('divOp' + button_id + '');
            element.remove();
        });

        $('form').on('click', '.add-opcao', function () {
            var button_id = $(this).attr("id");
            $('#campo' + button_id + '').append('<div class="form-row mt-3 campo' + button_id + '" id="divOp' + alt + '"><div class=" custom-control custom-radio mb-3">  <input name="radio' + button_id + '" class="custom-control-input" id="opcao' + alt + '" type="radio" disabled>  <label class="custom-control-label" for="opcao' + alt + '"> </label> </div> <input type="text"  name="opcaoInput' + button_id + '[]" placeholder="Digite a nova opção" class="form-control col-10 ml-2 form-control-alternative " required=""> <button type="button" id="' + alt + '" class="btn btn-danger ml-2 btn-apagar-alt"> <i class="fas fa-minus"></i> </button> </div>');

            alt++;
        });

    </script>
@endsection