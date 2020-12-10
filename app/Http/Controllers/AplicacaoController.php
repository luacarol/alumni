<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Aplicacao;


class AplicacaoController extends Controller
{
    public function edit($id)
    {
        if(Session::has('extensao'))
        {
            if(DB::table('respostaalternativa')->where('idAplicacao', $id)->doesntExist() && DB::table('respostadissertativa')->where('idAplicacao', $id)->doesntExist())
            {
                $questionarios = DB::table('questionario')
                        ->whereIn('idUsuarioCex',DB::table('usuariocex')
                        ->where('idCampus',Session::get('extensao')->idCampus)
                        ->select('id'))
                        ->orderBy('id','desc')
                        ->get();

                $turmas = DB::table('cursocampus')
                        ->where('idCampus',Session::get('extensao')->idCampus)
                        ->join('curso','curso.id','=','cursocampus.idCurso')
                        ->select('curso.nome','curso.id')
                        ->get();

                $aplicacao = DB::table('aplicacao')
                        ->where('aplicacao.id',$id)
                        ->first();

                $aplicacaoTurmas = DB::table('cursoaplicacao')
                        ->where('idAplicacao',$id)
                        ->join('curso','curso.id','=','cursoaplicacao.idCurso')
                        ->select('curso.id')
                        ->get();

                return view('aplicacao.aplicacao-create')->with(compact(('questionarios'),('turmas'),('aplicacao'),('aplicacaoTurmas')));
            }

            return redirect()
                    ->back()
                    ->with('erro', 'Existem registros de resposta para essa aplicação e ela não pode ser alterada');


        }
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'dataInic' => 'required',
            'dataFim' => 'required',
            'turmas'=> 'required'
        ]);

        $aplicacao = Aplicacao::find($id);

        $aplicacao->idQuestionario = $request->get('questionario');
        $aplicacao->dataFim = date('Y-m-d',strtotime($request->get('dataFim')));
        $aplicacao->dataInicio = date('Y-m-d',strtotime($request->get('dataInic')));

        try 
        {
            $aplicacao->save();

            DB::table('cursoaplicacao')->where('idAplicacao', '=', $id)->delete();

            $turmas  = DB::table('cursocampus')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->join('curso','curso.id','=','cursocampus.idCurso')
                    ->select('curso.id')
                    ->get();

            foreach ($turmas as $turma) 
                {
                    if (isset($request->get('turmas')[$turma->id])) 
                    {
                        DB::table('cursoaplicacao')->insert(
                            ['idAplicacao' => $aplicacao->id, 'idCurso' => $turma->id]
                        );
                    }
                }



            return redirect('aplicacao/criar')->with('success','Aplicação salva com sucesso!');
        } 
        catch (Exception $e) 
        {
            return redirect('aplicacao/criar')->with('erro','Erro ao editar aplicação!');
        }
    }

    public function create()
    {

        if(Session::has('extensao'))
        {

            $questionarios = DB::table('questionario')
                    ->whereIn('idUsuarioCex',DB::table('usuariocex')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->select('id'))
                    ->orderBy('id','desc')
                    ->get();

            $turmas = DB::table('cursocampus')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->join('curso','curso.id','=','cursocampus.idCurso')
                    ->select('curso.nome','curso.id')
                    ->get();

            return view('aplicacao.aplicacao-create')->with(compact(('questionarios'),('turmas')));
        }
    }

    public function show($id)
    {

        if(Session::has('extensao'))
        {

            $aplicacao = DB::table('aplicacao')
                    ->where('aplicacao.id',$id)
                    ->join('questionario','aplicacao.idQuestionario','=','questionario.id')
                    ->select('questionario.titulo','aplicacao.*')
                    ->first();

            $turmas = DB::table('cursoaplicacao')
                    ->where('idAplicacao',$id)
                    ->join('curso','curso.id','=','cursoaplicacao.idCurso')
                    ->select('curso.nome')
                    ->get();

            return view('aplicacao.aplicacao-ver')->with(compact(('aplicacao'),('turmas')));
        }
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'dataInic' => 'required',
            'dataFim' => 'required',
            'turmas'=> 'required'
        ]);

        try {

            $aplicacao = new Aplicacao([
                'idQuestionario' => $request->get('questionario'),
                'dataInicio' => date('Y-m-d',strtotime($request->get('dataInic'))),
                'dataFim' => date('Y-m-d',strtotime($request->get('dataFim'))),
                'idCampus' => Session::get('extensao')->idCampus
            ]);

            $aplicacao->save();

            $turmas  = DB::table('cursocampus')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->join('curso','curso.id','=','cursocampus.idCurso')
                    ->select('curso.id')
                    ->get();

            try {

                foreach ($turmas as $turma) 
                {
                    if (isset($request->get('turmas')[$turma->id])) 
                    {
                        DB::table('cursoaplicacao')->insert(
                            ['idAplicacao' => $aplicacao->id, 'idCurso' => $turma->id]
                        );
                    }
                }

                return redirect('aplicacao/criar')->with('success','Aplicação salva com sucesso!');

                
            } catch (Exception $e) 
            {
                return redirect()
                    ->back()
                    ->with('erro', 'Falha ao cadastrar aplicação')
                    ->withInput();
            }

            

        } catch (Exception $e) {
            return redirect()
                    ->back()
                    ->with('erro', 'Falha ao cadastrar aplicação')
                    ->withInput();
        }

        

    	
        
    }

    public function index()
    {
        if(Session::has('extensao'))
        {
            $aplicacoes = DB::table('aplicacao')
            ->where('idCampus',Session::get('extensao')->idCampus)
            ->join('questionario','idQuestionario','=','questionario.id')
            ->select('aplicacao.*','questionario.titulo')
            ->get();

            return view('aplicacao.aplicacao-listar')->with(compact('aplicacoes'));
        }
    }

    public function destroy($id)
    {
        if(Session::has('extensao'))
        {
            $aplicacao = Aplicacao::findOrFail($id);

            if(DB::table('respostaalternativa')->where('idAplicacao', $id)->doesntExist() && DB::table('respostadissertativa')->where('idAplicacao', $id)->doesntExist())
            {
                try
                {
                    DB::table('cursoaplicacao')->where('idAplicacao', '=', $id)->delete();

                    $aplicacao->delete();

                    return redirect()->route('aplicacao.index')->with('success', 'Registro removido com sucesso!');
                }
                catch (\PDOException $e)
                {
                    return redirect()->route('aplicacao.index')->with('error', $e->getCode());
                } 
            }
            else
                return redirect()
                    ->back()
                    ->with('erro', 'Existem registros de resposta para essa aplicação e ela não pode ser apagada');
            
        }
    }

    public function relatorio($id)
    {
        $aplicacao = DB::table('aplicacao')->where('aplicacao.id',$id)
        ->join('questionario','questionario.id','=','aplicacao.idQuestionario')
        ->select('questionario.titulo','aplicacao.*')
        ->first();

        $alternativas = DB::table('respostaalternativa')
        ->join('pergunta','pergunta.id','=','respostaalternativa.idPergunta')
        ->join('alternativa','alternativa.idPergunta','=','pergunta.id')
        ->where('idAplicacao',$id)
        ->get();

        $alternativasResp = DB::table('respostaalternativa')
        ->select(DB::raw('count(*) as totalAlt'))
        ->groupBy('idAlternativa')
        ->where('idAplicacao',$id)
        ->get();

        $total = DB::table('respostaalternativa')
        ->where('idAplicacao',$id)
        ->count();

        $dissertativas = DB::table('respostadissertativa')
        ->join('pergunta','pergunta.id','=','respostadissertativa.idPergunta')
        ->where('idAplicacao',$id)
        ->get();

        return \PDF::loadView('relatorio.relatorio', compact(('alternativas'),('dissertativas'),('aplicacao'),('alternativasResp'),('total')))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->download('relatorioAlumni.pdf');
    }
}
