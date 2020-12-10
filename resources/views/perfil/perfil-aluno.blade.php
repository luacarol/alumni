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
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <ul class="nav nav-pills nav-justified mb-3 col-11" id="pills-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-pessoais" role="tab" aria-controls="pills-home" aria-selected="true">Dados Pessoais</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-academicos" role="tab" aria-controls="pills-profile" aria-selected="false">Dados Acadêmicos</a>
                          </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-pessoais" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form class="mr-5 ml-5 mt-3 mb-4">
                                <div class="form-row">
                                    <div class="col-sm-12 mb-3">
                                        <label>Nome</label>
                                        <input type="text" name="nome" class="form-control" value="{{$aluno->nome}}" disabled>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label>Data de Nascimento</label>
                                        <input type="text" name="dataNasc" value="{{date('d/m/Y',strtotime($aluno->dataNasc))}}" class="form-control" disabled="">
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label>CPF</label>
                                        <input type="text" name="cpf" class="form-control" disabled value="{{$aluno->cpf}}">
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label>RG</label>
                                        <input type="text" name="rg" class="form-control" disabled value="{{$aluno->rg}}">
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <label>Endereço</label>
                                        <textarea class="form-control" disabled></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-academicos" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="mr-5 ml-5 mt-3 mb-4 ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Curso</th>
                                            <th>Campus</th>
                                            <th>Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($formacao as $form)
                                                <tr>
                                                    <td>{{$form->nome}}</td>
                                                    <td>{{$form->sigla}}</td>
                                                    <td>{{$form->status}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

