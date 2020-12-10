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
                </div>
                <div class="card-body">
                    <form class="mr-5 ml-5 mt-3 mb-4">
                        <div class="form-row">
                            <div class="col-sm-12 mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" class="form-control" disabled value="{{$ext->nome}} {{$ext->sobrenome}}">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>Campus</label>
                                <input type="text" name="cpf" class="form-control" disabled value="{{$campus->sigla}}">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label>Gênero</label>
                                <input type="text" name="genero" class="form-control" disabled value="{{$genero->genero}}">
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" disabled value="{{$login->email}}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

