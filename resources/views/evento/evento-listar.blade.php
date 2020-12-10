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
                        <h3 class="mb-sm-2 col-9">Eventos Disponíveis</h3>
                        <a href="{{route('evento.criar')}}" class="btn btn-success float-right">Cadastrar Evento <i class="fas fa-plus-square ml-2"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">id</th>
                                <th scope="col" class="text-center">Titulo</th>
                                <th scope="col" class="text-center">Data</th>
                                <th scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                  
                        @if($eventos->count() == 0)
                        <tr>
                            <td class="text-center" colspan="4">Nenhum evento cadastrado</td>
                        </tr>
                        @else
                            @foreach($eventos as $evento)
                            <tr>
                                <td class="text-center">{{$evento->id}}</td>
                                <td class="text-center">{{$evento->titulo}}</td>
                                <td class="text-center">{{date('d/m/Y',strtotime($evento->data))}}</td>
                                <td class="text-center">
                                    <a href="{{route('evento.editar',$evento->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-pencil-alt "></i>
                                    </a>
                                    <a href="{{route('evento.deletar',$evento->id)}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deletar">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    <a href="{{route('evento.ver',$evento->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                    
@endsection

@section('script')


@endsection