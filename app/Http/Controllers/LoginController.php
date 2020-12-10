<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\UsuarioAluno;
use App\Login;
use App\Genero;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.index');   
    }
    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);


        $login = DB::table('login')->where('email',$request->email)->first();

        if($login)
        { 
            if(Hash::check($request->password,$login->password))
            {
                if ($login->idTipoUsuario == 1) 
                {
                   $aluno = DB::table('usuarioaluno')->where('idLogin', $login->id)->first();

                    Session::put('aluno',$aluno);

                    $genero = Genero::find($aluno->idGenero);
                    $login = Login::find($aluno->idLogin);                    
                    $formacao = DB::table('matricula')->where('cpfAluno',$aluno->cpf)
                    ->join('curso','curso.id','=','matricula.idCurso')
                    ->join('campus','campus.id','=','matricula.idCampus')
                    ->join('statusformacao','statusformacao.id','=','matricula.idStatusFormacao')
                    ->select('curso.nome','campus.sigla','statusformacao.status')
                    ->get();

                    return view('perfil.perfil-aluno')->with(compact(('aluno'),('login'),('genero'),('formacao'))); 
                }
                elseif ($login->idTipoUsuario == 2) {

                    $ext = DB::table('usuariocex')->where('idLogin', $login->id)->first();

                    $campus = DB::table('campus')->where('id',$ext->idCampus)->first();

                    //echo($ext->id);
                    Session::put('extensao',$ext);

                    $genero = Genero::find($ext->idGenero);
                    $login = Login::find($ext->idLogin);                    


                    return view('perfil.perfil-extensao')->with(compact(('ext'),('login'),('genero'),('campus'))); 
                }
                else
                {
                    echo('ADM');
                }
            }
            else
            {
                return view('login.index')->with('erro','Senha Incorreta!');
            }
        }
        else{
            return view('login.index')->with('erro','Email Incorreto!');
        }
    }


    public function logout(){
        Session::flush();
        return redirect('login');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
