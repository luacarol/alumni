@extends('base')

@section('main')

    <div class="container-fluid mt--4">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0 row">
                        <h3 class="mb-sm-2 col-9">Vagas de Emprego Disponíveis</h3>
                    </div>
                    <div class="card-body">
                        @foreach($empregos as $emprego)
                            <div class="row mt-3">
                                @if($emprego->imagem != '')
                                    <div class="col-lg-5 mb-3 mt-3">
                                      <img class="img-fluid" src="{{ url("storage/uploadEmpregos/{$emprego->imagem}") }}">
                                    </div>
                                @endif
                                 <div class="col-lg-7 mb-3 mt-3">
                                    <h3 class="text-capitalize">{{$emprego->nomeVaga}}

                                    </h3>
                                    <p>Data de Publicação {{date('d/m/Y',strtotime($emprego->dataPublicacao))}}</p>
                                    <!-- {{-- <small>Número de egressos interessados: {{count($evento->interessados)}}</small> --}} -->
                                    <p class="text-justify">@php echo $emprego->preRequisitos; @endphp</p>
                                    <a href="{{route('emprego.ver',$emprego->id)}}" class="btn btn-block col-4 btn-primary">Ver Vaga de Emprego</a>
                                 </div>
                            </div>
                            <hr style="border: 1px dashed #d3d3d3;">
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')


@endsection
