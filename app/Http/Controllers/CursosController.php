<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CursoCampus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CursosController extends Controller
{
    public function destroy($id)
    {
        if(DB::table('matricula')->where('idCurso',$id)->exists())
        {
            return redirect('curso')->with('erro','Falha ao deletar curso!');
        }
        try {

            DB::table('cursocampus')->where('idCurso', '=', $id)->delete();
            return redirect('curso')->with('success','Curso deletado com sucesso!');
            
        } catch (Exception $e) {
            return redirect('curso')->with('erro','Falha ao deletar curso!');
        }
    }

    public function index()
    {
        $cursos = DB::table('cursocampus')
        ->join('curso','curso.id','=','cursocampus.idCurso')
        ->join('nivel','nivel.id','=','curso.nivel')
        ->where('cursocampus.idCampus','=',Session::get('extensao')->idCampus)
        ->select('cursocampus.*','curso.nome','nivel.nivel')
        ->get();

        return view('curso.curso-listar')->with(compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = DB::table('curso')->get();

        return view('curso.curso-create')->with(compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try 
        {
            DB::table('cursocampus')->insert(
                ['idCurso' => $request->get('curso'), 'idCampus' => Session::get('extensao')->idCampus]
            );
            return redirect('curso/criar')->with('success','Curso salvo com sucesso!');
            
        } catch (Exception $e) 
        {
            return redirect('curso/criar')->with('erro','Falha ao salvar curso!');
        }
    }
}
