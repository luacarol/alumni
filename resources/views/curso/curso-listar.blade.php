@extends('base')

@section('headerPg')

<div class="row justify-content-center pl-3 pr-3">
    <form class="mt-4 mb-3 col-12">
        <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Pesquisar Curso" aria-label="Search">
            <div class="input-group-prepend">
                <button class="btn btn-outline-info" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
</div>

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
                        <h3 class="mb-2 col-9">Gerenciamento de Cursos</h3>
                        <a href="{{route('curso.criar')}}" class="btn btn-success float-right">Cadastrar Curso <i class="fas fa-plus-square ml-2"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">id</th>
                                    <th scope="col" class="text-center">Nome</th>
                                    <th scope="col" class="text-center">Nível</th>
                                    <th scope="col" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cursos as $curso)
                                <tr>
                                    <td class="text-center">{{$curso->idCurso}}</td>
                                    <td class="text-center">{{$curso->nome}}</td>
                                    <td class="text-center">{{$curso->nivel}}</td>
                                    <td class="text-center">
                                        <a href="{{route('curso.apagar',$curso->idCurso)}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deletar">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection