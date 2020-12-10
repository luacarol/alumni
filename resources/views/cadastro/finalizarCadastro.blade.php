<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Alumni</title>
		<!-- Favicon -->
		<link href="{{ asset('img/brand/favicon.png') }}" rel="icon" type="image/png">
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
		<!-- Icons -->
		<link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
		<link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
		<!-- CSS Files -->
		<link href="{{ asset('css/argon-dashboard.css?v=1.1.0') }}" rel="stylesheet" />

		<script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>

		<script src="{{ asset('js/jquery.mask.min.js') }}"></script>

	</head>
	<body>

		<div class="container">
			<div class="row d-flex align-content-center justify-content-center">
				<div class="card shadow border-0 col-md-8 border-0 pr-0 pl-0 pb-2 mt-5">
					<div class="card-header pl-4 border-0">
						<h3 class="text-center mt-3">Cadastre-se no Alumni</h3>
						<p class="text-center">Encontre ex-alunos e estabeleça contato pessoal e profissional.</p>
					</div>
					<div class="card-body">
						@if(session()->get('success'))
					        <div class="alert alert-success">
					          {{ session()->get('success') }}  
					        </div>
					    @endif
					    @if(isset($erro))
					        <div class="alert alert-danger">
					          {{ $erro }}  
					        </div>
					    @endif
					    @if ($errors->any())
					        <div class="alert alert-danger">
					          <ul>
					              @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					              @endforeach
					          </ul>
					        </div>
					    @endif
						<form class="mt-3" action="{{route('cadastro.salvar')}}" method="POST">
							<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							<div class="form-row">
								<div class="form-group col-12">
				                  	<div class="input-group input-group-alternative">
				                    	<div class="input-group-prepend">
				                      		<span class="input-group-text"><i class="fas fa-user"></i></span>
				                    	</div>
				                    	<input type="text" class="form-control " id="nome" name="nome" placeholder="Digite seu nome" required="" value="{{$aluno->nome}}">
				                  	</div>
				                </div>
							</div>
							<div class="form-row">
								<div class="form-group col-6">
				                  	<div class="input-group input-group-alternative">
				                    	<div class="input-group-prepend">
				                      		<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
				                    	</div>
				                    	<input type="text" class="form-control " id="dataNasc" name="dataNasc" required="" onkeypress="$(this).mask('00/00/0000');" placeholder="Digite sua data de nascimento">
				                  	</div>
				                </div>
				                <div class="form-group col-6">
				                  	<select class="form-control-alternative form-control" name="genero" id="genero">
							      		@foreach($generos as $genero)
								      		<option value="{{$genero->id}}">{{$genero->genero}}</option>
							      		@endforeach
							      	</select>
				                </div>
							</div>

							<div class="form-row">
								<div class="form-group col-6">
				                  	<div class="input-group input-group-alternative">
				                    	<div class="input-group-prepend">
				                      		<span class="input-group-text"><i class="far fa-id-card"></i></span>
				                    	</div>
				                    	<input type="text" class="form-control " id="rg" name="rg" placeholder="Digite seu RG" required="" onkeypress="$(this).mask('00.000.000-A');">
				                  	</div>
				                </div>

				                <div class="form-group col-6">
				                  	<div class="input-group input-group-alternative">
				                    	<div class="input-group-prepend">
				                      		<span class="input-group-text"><i class="far fa-id-card"></i></span>
				                    	</div>
				                    	<input type="text" class="form-control " id="cpf" name="cpf" placeholder="Digite seu CPF" required="" readonly="" value="{{$aluno->cpf}}">
				                  	</div>
				                </div>
							</div>

							<div class="form-row">
								<div class="form-group col-12">
				                  	<div class="input-group input-group-alternative">
				                    	<div class="input-group-prepend">
				                      		<span class="input-group-text"><i class="fas fa-envelope"></i></span>
				                    	</div>
				                    	<input type="email" class="form-control " id="email" name="email" placeholder="Digite seu email" required="">
				                  	</div>
				                </div>
							</div>

							<div class="form-row">
								<div class="form-group col-6">
				                  	<div class="input-group input-group-alternative">
				                    	<div class="input-group-prepend">
				                      		<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
				                    	</div>
				                    	<input type="password" class="form-control " id="senha" name="senha" placeholder="Digite uma senha" required="">
				                  	</div>
				                </div>
				                <div class="form-group col-6">
				                  	<div class="input-group input-group-alternative">
				                    	<div class="input-group-prepend">
				                      		<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
				                    	</div>
				                    	<input type="password" class="form-control " id="confirmaSenha" name="confirmaSenha" placeholder="Confirmar senha" required="">
				                  	</div>
				                </div>
							</div>
							
						    <button class="btn col-8 offset-2 btn-primary rounded-pill mt-4 mb-2" type="submit">Finalizar <i class="fas fa-chevron-right ml-2"></i></button>
						</form>
						<p class="text-center mg-t-3 text-blue"><a href="{{route('login')}}">Já possuo conta: Fazer Login</a></p>
					</div>
				</div>
			</div>
		</div>

		
		 <!--   Core   -->
		<script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
		  
		  <!--   Argon JS   -->
		<script src="{{ asset('js/argon-dashboard.min.js?v=1.1.0') }}"></script>
		<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
		<script>
		    window.TrackJS &&
		      TrackJS.install({
		        token: "ee6fab19c5a04ac1a32a645abde4613a",
		        application: "argon-dashboard-free"
		    });
		</script>
	</body>
</html>