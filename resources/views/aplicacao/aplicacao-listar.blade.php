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
                        <h3 class="mb-sm-2 col-9">Aplicações Disponíveis</h3>
                        <a href="{{route('aplicacao.criar')}}" class="btn btn-success float-right">Cadastrar Aplicação <i class="fas fa-plus-square ml-2"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Questionário</th>
                                <th scope="col" class="text-center">Data de Início</th>
                                <th scope="col" class="text-center">Data de término</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                  
                        @if($aplicacoes->count() == 0)
                        <tr>
                            <td class="text-center" colspan="4">Nenhuma aplicação cadastrada</td>
                        </tr>
                        @else
                        @foreach($aplicacoes as $aplicacao)
                            <tr>
                                <td class="text-center">{{$aplicacao->titulo}}</td>
                                <td class="text-center">{{date('d/m/Y',strtotime($aplicacao->dataInicio))}}</td>
                                <td class="text-center">{{date('d/m/Y',strtotime($aplicacao->dataFim))}}</td>
                                @if(date('d/m/Y') > strtotime($aplicacao->dataFim))
                                    <td class="text-center text-danger">
                                        Encerrada
                                    </td>
                                @else
                                    <td class="text-center text-success">
                                        Em Andamento
                                    </td>
                                @endif
                                <td class="text-center">
                                    <a href="{{route('aplicacao.editar',$aplicacao->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-pencil-alt "></i>
                                    </a>
                                    <a href="{{route('aplicacao.apagar',$aplicacao->id)}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deletar">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    <a href="{{route('aplicacao.ver',$aplicacao->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('aplicacao.relatorio',$aplicacao->id)}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Relatório">
                                        <i class="far fa-file-pdf"></i>
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