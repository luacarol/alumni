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
                        <h3 class="mb-sm-2 col-9">Mensagens Disponíveis</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Assunto</th>
                                <th scope="col" class="text-center">Data de envio</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                  
                        @if($mensagens->count() == 0)
                        <tr>
                            <td class="text-center" colspan="4">Nenhuma mensagem recebida</td>
                        </tr>
                        @else
                        @foreach($mensagens as $mensagem)
                            <tr>
                                <td class="text-center">{{$mensagem->assunto}}</td>
                                <td class="text-center">{{date('d/m/Y',strtotime($mensagem->data))}}</td>
                                @if($mensagem->status == 'V')
                                    <td class="text-center text-success">Visualizado</td>
                                @else
                                    <td class="text-center text-gray-dark">Não Visualizado</td>
                                @endif
                                <td class="text-center">
                                    <a href="{{route('mensagem.ler',$mensagem->id)}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Visualizar">
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