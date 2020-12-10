<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionario;
use App\Pergunta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuestionarioController extends Controller
{
    public function index()
    {
        if(Session::has('extensao'))
        {

            $questionarios = DB::table('questionario')
                    ->whereIn('idUsuarioCex',DB::table('usuariocex')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->select('id'))
                    ->orderBy('id','desc')
                    ->get();

            return view('questionario.questionario-listar')->with(compact('questionarios'));
        }

        if(Session::has('aluno'))
        {
            $questionarios = DB::table('questionario')
                    ->whereIn('questionario.id',DB::table('aplicacao')
                        ->whereIn('aplicacao.id',DB::table('matricula')
                            ->where('cpfAluno',Session::get('aluno')->cpf)
                            ->join('cursoaplicacao','matricula.idCurso','=','cursoaplicacao.idCurso')
                            ->select('cursoaplicacao.idAplicacao'))
                        ->where('aplicacao.dataFim','>',date('Y-m-d'))
                        ->where('aplicacao.dataInicio','<=',date('Y-m-d'))
                        ->select('idQuestionario'))
                    ->join('aplicacao','aplicacao.idQuestionario','=','questionario.id')
                    ->where('aplicacao.dataFim','>',date('Y-m-d'))
                    ->where('aplicacao.dataInicio','<=',date('Y-m-d'))
                    ->select('questionario.*','aplicacao.id as aplicacao')
                    ->orderBy('questionario.id','desc')
                    ->get();

            return view('questionario.questionario-aluno-listar')->with(compact('questionarios'));
        }
        
    }

    public function create()
    {
        return view('questionario.questionario-create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required',
            'descricao' => 'required'
        ]);

        
        $questionario = new Questionario([
            'titulo' => $request->get('titulo'),
            'descricao' => $request->get('descricao'),
            'idUsuarioCex' => Session::get('extensao')->id
        ]);

        try 
        {
            $questionario->save();

            return redirect()->route('pergunta.criar', $questionario->id)->with('success', 'Questionario salvo com sucesso!');

        } 
        catch (Exception $e) 
        {
            return redirect('questionario/criar')->with('erro','Erro ao salvar questionario!');
        }       
  
    }

    public function show(Request $request, $id,$aplicacao)
    {
        if(Session::has('extensao'))
        {

            $questionario = DB::table('questionario')
                    ->where('id',$id)
                    ->first();

            $perguntas = Pergunta::where('idQuestionario', $id)->get();

            return view('questionario.questionario-responder')->with(compact(('questionario'),('perguntas')));
        }
        else
        {
            $questionario = DB::table('questionario')
                    ->where('id',$id)
                    ->first();

            $perguntas = Pergunta::where('idQuestionario', $id)->get();


            return view('questionario.questionario-responder')->with(compact(('questionario'),('perguntas'),('aplicacao')));
        }
    }

    public function edit($id)
    {
        $questionario = DB::table('questionario')->where('id',$id)->first();
        return view('questionario.questionario-create')->with(compact('questionario'));
    }

    public function responder(Request $request, $id)
    {
        $this->validate($request, [
            'dissertativas'=> 'required'
        ]);

        $perguntas = DB::table('pergunta')->where('idQuestionario',$id)->where('tipo','A')->get();
        try {
            foreach ($perguntas as $pergunta) 
            {
                DB::insert('insert into respostaalternativa (cpfAluno, idAplicacao,idPergunta,idAlternativa) values (?, ?, ?, ?)', [Session::get('aluno')->cpf, $request->get('aplicacao'),$pergunta->id,$request->get('alternativas'.$pergunta->id)]);
            }

            $perguntas = DB::table('pergunta')->where('idQuestionario',$id)->where('tipo','D')->get();

            foreach ($perguntas as $pergunta) 
            {
                DB::insert('insert into respostadissertativa (cpfAluno, idAplicacao,idPergunta,resposta) values (?, ?, ?, ?)', [Session::get('aluno')->cpf, $request->get('aplicacao'),$pergunta->id,$request->get('dissertativas')[$pergunta->id]]);
            }

            return redirect('questionario')->with('success','Questionario salvo com sucesso!');


        } catch (Exception $e) {
            return redirect('questionario')->with('erro','Erro ao salvar questionario!');

        }
            

    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
         
    }
}
