<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;
use App\UsuarioAluno;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EgressoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = DB::table('usuarioaluno')
        ->join('matricula','matricula.cpfAluno','=','cpf')
        ->where('matricula.idCampus','=',Session::get('extensao')->idCampus)
        ->select('matricula.prontuario','usuarioaluno.*')
        ->get();

        return view('usuarioaluno.usuarioaluno-listar')->with(compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos = DB::table('genero')->get();

        $cursos = DB::table('cursocampus')
        ->join('curso','curso.id','=','cursocampus.idCurso')
        ->where('cursocampus.idCampus','=',Session::get('extensao')->idCampus)
        ->select('cursocampus.*','curso.nome')
        ->get();

        return view('usuarioaluno.usuarioaluno-cadastro',compact(('generos'),('cursos')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'cpf' => 'required',
            'prontuario' => 'required',
            'genero' => 'required',
            'curso' => 'required'
        ]);

        try 
        {
         
            $aluno = new UsuarioAluno([
                'cpf' => $request->get('cpf'),
                'nome' => $request->get('nome'),
                'idGenero' => $request->get('genero')
            ]);

            $aluno->save();

            $matricula = new Matricula([
                'cpfAluno' => $request->get('cpf'),
                'prontuario' => $request->get('prontuario'),
                'idCurso' => $request->get('curso'),
                'idStatusFormacao' => 1,
                'idCampus' => Session::get('extensao')->idCampus
            ]);

            $matricula->save();

            return redirect('egresso/criar')->with('success','Egresso salvo com sucesso!');

        } catch (Exception $e) 
        {
            return redirect('egresso/criar')->with('erro','Falha ao salvar egresso!');   
        }

        

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cpf)
    {
        $aluno =  DB::table('usuarioaluno')->where('cpf', $cpf)->first();

        $matricula = DB::table('matricula')->where('cpfAluno', $cpf)->first(); 

        $generos = DB::table('genero')->get();

        $cursos = DB::table('cursocampus')
        ->join('curso','curso.id','=','cursocampus.idCurso')
        ->where('cursocampus.idCampus','=',Session::get('extensao')->idCampus)
        ->select('cursocampus.*','curso.nome')
        ->get();   

        return view('usuarioaluno.usuarioaluno-cadastro',compact(('generos'),('cursos'),('aluno'),('matricula')));            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'cpf' => 'required',
            'prontuario' => 'required',
            'genero' => 'required',
            'curso' => 'required'
        ]);

        try 
        {
         
            $aluno = UsuarioAluno::findOrFail($request->get('cpf'));

            $aluno->cpf =  $request->get('cpf');
            $aluno->nome =  $request->get('nome');
            $aluno->idGenero =  $request->get('idGenero');

            $aluno->save();

            $matricula = Matricula::where('cpfAluno',$request->get('cpf'))->first();

            
            $matricula->cpfAluno = $request->get('cpf');
            $matricula->prontuario = $request->get('prontuario');
            $matricula->idCurso = $request->get('curso');
            
            $matricula->save();

            return redirect('egresso/'.$request->get('cpf').'/editar')->with('success','Egresso salvo com sucesso!');

        } catch (Exception $e) 
        {
            return redirect('egresso/'.$request->get('cpf').'/editar')->with('erro','Falha ao salvar egresso!');   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cpf)
    {
        $aluno = UsuarioAluno::findOrFail($cpf);

        $matricula = Matricula::where('cpfAluno', $cpf)->first();

        try
        {
            $matricula->delete();
            $aluno->delete();
            return redirect()->route('egresso.index')->with('success', 'Registro removido com sucesso!');
        }
        catch (\PDOException $e)
        {
            return redirect()->route('egresso.index')->with('error', $e->getCode());
        } 
    }
}
