<?php


Route::get('perfil', 'AlunoController@index')->name('perfil.aluno');


Route::get('teste', function () {
    return view('aplicacao.aplicacao-create');
});

Route::get('/', 'IndexController@index');

//================================================================================================
//==================					ROTAS DE PERFIL 						==================
//================================================================================================
Route::get('perfil', 'AlunoController@index')->name('perfil.aluno');
Route::get('perfil/editar', 'AlunoController@edit')->name('perfil.aluno.editar');
Route::post('perfil/atualizar/{cpf}', 'AlunoController@update')->name('perfil.aluno.atualizar');

Route::get('extensao', 'ExtensaoController@index')->name('perfil.extensao');


//================================================================================================
//==================					ROTAS DE CADASTRO 						==================
//================================================================================================
Route::get('cadastro', 'CadastroController@index')->name('cadastro');
Route::post('cadastro/validar', 'CadastroController@valida')->name('cadastro.validar');
Route::post('cadastro/salvar', 'CadastroController@store')->name('cadastro.salvar');

//================================================================================================
//==================					  ROTAS DE LOGIN 						==================
//================================================================================================
Route::get('login', 'LoginController@index')->name('login');
Route::post('logar', 'LoginController@login')->name('logar');
Route::get('logout', 'LoginController@logout')->name('logout');


//================================================================================================
//==================					  ROTAS DE EVENTO 						==================
//================================================================================================
Route::get('eventos', 'ControllerEvento@index')->name('evento.index');
Route::get('eventos/visualizar/{id}', 'ControllerEvento@show')->name('evento.ver');
Route::get('evento/criar', 'ControllerEvento@create')->name('evento.criar');
Route::post('evento/salvar', 'ControllerEvento@store')->name('evento.salvar');
Route::get('evento/{id}/editar', 'ControllerEvento@edit')->name('evento.editar');
Route::post('evento/{id}/atualizar', 'ControllerEvento@update')->name('evento.atualizar');
Route::get('evento/{id}/deletar', 'ControllerEvento@destroy')->name('evento.deletar');


//================================================================================================
//==================					  ROTAS DE NOTICIA 						==================
//================================================================================================
Route::get('noticias', 'NoticiaController@index')->name('noticia.index');
Route::get('noticia/{id}/ler', 'NoticiaController@show')->name('noticia.ler');
Route::get('noticia/criar', 'NoticiaController@create')->name('noticia.criar');
Route::post('noticia/salvar', 'NoticiaController@store')->name('noticia.salvar');
Route::get('noticia/{id}/editar', 'NoticiaController@edit')->name('noticia.editar');
Route::get('noticia/{id}/deletar', 'NoticiaController@destroy')->name('noticia.deletar');
Route::post('noticia/{id}/atualizar', 'NoticiaController@update')->name('noticia.atualizar');

//================================================================================================
//==================				 ROTAS DE CADASTRO ALUNO  					==================
//================================================================================================
Route::get('egresso', 'EgressoController@index')->name('egresso.index');
Route::get('egresso/criar', 'EgressoController@create')->name('egresso.criar');
Route::get('egresso/{cpf}/editar', 'EgressoController@edit')->name('egresso.editar');
Route::post('egresso/salvar', 'EgressoController@store')->name('egresso.salvar');
Route::post('egresso/atualizar', 'EgressoController@update')->name('egresso.atualizar');
Route::get('egresso/{cpf}/deletar', 'EgressoController@destroy')->name('egresso.deletar');

//================================================================================================
//==================					 ROTAS DE CAMPUS  						==================
//================================================================================================
Route::get('curso', 'CursosController@index')->name('curso.index');
Route::get('curso/criar', 'CursosController@create')->name('curso.criar');
Route::get('curso/deletar/{id}', 'CursosController@destroy')->name('curso.apagar');
Route::post('curso/salvar', 'CursosController@store')->name('curso.salvar');

//================================================================================================
//==================					 ROTAS DE QUESTIONARIO  				==================
//================================================================================================
Route::get('questionario', 'QuestionarioController@index')->name('questionario.index');
Route::get('questionario/criar', 'QuestionarioController@create')->name('questionario.criar');
Route::post('questionario/salvar', 'QuestionarioController@store')->name('questionario.salvar');
Route::get('questionario/{id}/editar', 'QuestionarioController@edit')->name('questionario.editar');

Route::get('questionario/{id}/pergunta/criar', 'PerguntaController@create')->name('pergunta.criar');
Route::post('questionario/{id}/pergunta/salvar', 'PerguntaController@store')->name('pergunta.salvar');


Route::get('questionario/{id}/responder/{aplicacao}', 'QuestionarioController@show')->name('questionario.ver');

Route::post('questionario/{id}/gravar', 'QuestionarioController@responder')->name('questionario.responder');

//================================================================================================
//==================					   ROTAS DE APLICAÇÃO  			     	==================
//================================================================================================
Route::get('aplicacao', 'AplicacaoController@index')->name('aplicacao.index');
Route::get('aplicacao/criar', 'AplicacaoController@create')->name('aplicacao.criar');
Route::post('aplicacao/salvar', 'AplicacaoController@store')->name('aplicacao.salvar');
Route::get('aplicacao/deletar/{id}', 'AplicacaoController@destroy')->name('aplicacao.apagar');
Route::get('aplicacao/{id}/ver', 'AplicacaoController@show')->name('aplicacao.ver');
Route::get('aplicacao/{id}/editar', 'AplicacaoController@edit')->name('aplicacao.editar');
Route::post('aplicacao/{id}/atualizar', 'AplicacaoController@update')->name('aplicacao.atualizar');

Route::get('aplicacao/relatorio/{id}', 'AplicacaoController@relatorio')->name('aplicacao.relatorio');


//================================================================================================
//==================					ROTAS DE MENSAGEM INDEX  		     	==================
//================================================================================================
Route::post('send', 'MensagemIndexController@send')->name('mensagem.enviar');
Route::get('mensagens', 'MensagemIndexController@index')->name('mensagem.index');
Route::get('mensagem/{id}/ler', 'MensagemIndexController@show')->name('mensagem.ler');





