<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionario;
use App\Pergunta;
use App\Alternativa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PerguntaController extends Controller
{
    public function index()
    {
        if(Session::has('extensao'))
        {
            $perguntas = DB::table('pergunta')
            ->join('questionario','questionario.idUsuarioCex','=',Session::get('extensao')->id)
            - get();
        }
        else
        {
            return redirect()->back()->with('erro','Acesso negado');
        }
    }

    public function create($id)
    {
        $questionario = Questionario::find($id);
        return view('questionario.pergunta-create')->with(compact('questionario'));
    }
    
    public function store(Request $request,$questionario)
    {
        $i = 0;
        $erro = 0;
        if($alternativas = $request->get('alternativa'))
        {
            if ($cont = $request->get('idAlt')) 
            {
                foreach ($alternativas as $alternativa) 
                {
                    echo($alternativa.'<br>');
                    echo($cont[$i].'<br>');
                    if ($opcoes = $request->get('opcaoInput'.$cont[$i])) 
                    {
                        $pergunta = new Pergunta([
                            'pergunta' => $alternativa,
                            'tipo' => 'A',
                            'idQuestionario' => $questionario
                        ]);

                        try 
                        {
                            $pergunta->save();
                        } catch (Exception $e) 
                        {
                            return redirect()->back()->with('erro','Erro ao salvar pergunta!');
                        }

                        foreach ($opcoes as $opcao) 
                        {
                            $alternativa = new Alternativa([
                                'alternativa' => $opcao,
                                'idPergunta' => $pergunta->id,
                            ]);

                            try 
                            {
                                $alternativa->save();
                            } catch (Exception $e) 
                            {
                                return redirect()->back()->with('erro','Erro ao salvar alternativa!');
                            }
                        }
                    }
                    else
                        $erro++;
                    $i++;

                    echo('<hr style="border-style: dashed;">');
                    
                }
            }
        }
        if ($dissertativas = $request->get('dissertativa')) 
        {
            foreach ($dissertativas as $dissertativa) 
            {
                $pergunta = new Pergunta([
                    'pergunta' => $dissertativa,
                    'tipo' => 'D',
                    'idQuestionario' => $questionario
                ]);

                try 
                {
                    $pergunta->save();
                } catch (Exception $e) 
                {
                    return redirect()->back()->with('erro','Erro ao salvar pergunta!');
                }
            }
        }
        if($erro > 0)
            return redirect('questionario')->with('warning','Algumas perguntas do tipo alternativa não foram salvas!');
        else
            return redirect('questionario')->with('success','Perguntas salvas com sucesso');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }
    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
         
    }
}
