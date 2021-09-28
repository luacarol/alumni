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
                        <h3 class="mb-sm-2 col-9">Vagas de Emprego Disponíveis</h3>
                        <a href="{{route('emprego.criar')}}" class="btn btn-success float-right">Inserir Vaga de Emprego<i class="fas fa-plus-square ml-2"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">id</th>
                                <th scope="col" class="text-center">Nome da Vaga</th>
                                <th scope="col" class="text-center">Data de Publicação</th>
                                <th scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                  
                        @if($empregos->count() == 0)
                        <tr>
                            <td class="text-center" colspan="4">Nenhuma vaga de emprego encontrada</td>
                        </tr>
                        @else
                            @foreach($empregos as $emprego)
                            <tr>
                                <td class="text-center">{{$emprego->id}}</td>
                                <td class="text-center">{{$emprego->nomeVaga}}</td>
                                <td class="text-center">{{date('d/m/Y',strtotime($emprego->dataPublicacao))}}</td>
                                <td class="text-center">
                                    <a href="{{route('emprego.editar', $emprego->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-pencil-alt "></i>
                                    </a>
                                    <a href="{{route('emprego.deletar',$emprego->id)}}" onclick="return confirm('Deseja mesmo deletar?');" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deletar">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    <a href="{{route('emprego.ver',$emprego->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Visualizar">
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