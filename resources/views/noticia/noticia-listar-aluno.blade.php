@extends('base')

@section('main')

    <div class="container-fluid mt--4">
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0 row">
                        <h3 class="mb-sm-2 col-9">Notícias Disponíveis</h3>
                    </div>
                    <div class="card-body">
                        @foreach($noticias as $noticia)
                            <div class="row mt-3">
                                 <div class="col-lg-2 mb-3 mt-3">
                                    @if($noticia->imagem != '')
                                      <img class="img-fluid" src="{{ url("storage/uploadNoticias/{$noticia->imagem}") }}">
                                    @endif
                                 </div>
                                 <div class="col-lg-10 mb-3 mt-3">
                                    <h3>{{$noticia->titulo}}</h3>
                                    <p class="text-justify">{{$noticia->lide}}</p>
                                    <a href="{{route('noticia.ler',$noticia->id)}}" class="btn btn-block col-4 btn-primary">Continuar Lendo</a>
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