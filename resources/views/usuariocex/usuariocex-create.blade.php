@extends('base')
@section('content')
<div class="p-4">
    <div class="card">
        <div class="mt-2 ml-4 mr-4 mb-4">
            <div class="d-flex justify-content-center mt-3">
                    <div>
                        <h3>Cadastre um novo usuário extensão</h3>
                    </div>
            </div>
            <form class="needs-validation m-3" novalidate>
                <div class="form-row">

                    <div class="col-md-6 mb-3">
                        <label for="validationTooltip01">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="validationTooltip02">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenome" name="nome" placeholder="Sobrenome" required>
                    </div>

                    <div class="col-sm-12 mb-3">
                             <label for="">Campus</label>
                            <select class="form-control">		
                                <option selected>Selecione o Campus</option>
                                <option value="1">ifsp jcr</option>
                                <option value="2">ifsp sp</option>
                                <option value="3">ifsp rj</option>
                            </select>
                    </div>

                    <div class="col-sm-12  mb-3">
                            <label for="">Login</label>
                            <select class="form-control">		
                                <option selected>Login</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>	
                    </div>

                    <div class="col-lg-6 mb-3">
                    <label for="">Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input form-control" id="customFileLang" lang="pt-BR">
                            <label class="custom-file-label" for="customFileLang">Carregue sua foto</label>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                            <label for="">Gênero</label>
                            <select name="" id="" class="form-control">
                                    <option value="">Feminino</option>
                                    <option value="">Não binário</option>
                                    <option value="">Fluído</option>
                                    <option value="">Masculino</option>
                            </select>
                    </div>

                </div>

                </form>
            </div>
    </div>
</div>
@endsection