@extends('base')

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
                        <h3>Cadastre um Curso</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form class="m-3" action="{{route('curso.salvar')}}" method="POST">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-row ml-4 mr-4 mt-3 mb-4">
                            <div class="form-row">
                                <div class="col-md-9 mb-3">
                                    <label for="curso">Curso</label>
                                    <select class="form-control" name="curso" id="curso">
                                        @foreach($cursos as $curso)
                                            <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label></label>
                                    <input type="submit" value="Salvar Curso" class="btn btn-block btn-success" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







@endsection