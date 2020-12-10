<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ControllerEvento extends Controller
{
    public function index()
    {

        if(Session::has('extensao'))
        {

            $eventos = DB::table('evento')
                    ->whereIn('idUsuarioCex',DB::table('usuariocex')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->select('id'))
                    ->get();

            return view('evento.evento-listar')->with(compact('eventos'));
        }
        if(Session::has('aluno'))
        {

            $eventos = DB::table('evento')
                ->whereIn('idUsuarioCex',DB::table('usuariocex')
                    ->whereIn('usuariocex.idCampus',DB::table('matricula')
                        ->where('cpfAluno',Session::get('aluno')->cpf)
                        ->select('matricula.idCampus')
                    )->select('id'))
                ->leftJoin('interesseevento','interesseevento.idEvento','=','evento.id')
                ->select('evento.*','interesseevento.cpfAluno as interessados')
                ->get();
                
            return view('evento.evento-listar-aluno')->with(compact(('eventos')));
        }
    }

    public function create()
    {
        if(Session::has('extensao'))
            return view('evento.evento-create');
    }

    public function store(Request $request)
    {
        if(Session::has('extensao'))
        {
            $this->validate($request, [
                'titulo' => 'required',
                'descricao' => 'required',
                'data' => 'required',
    		    'horarioIn' => 'required',
    		    'horarioFin' => 'required'
            ]);

            $nameFile = null;
         
            if ($request->hasFile('image') && $request->file('image')->isValid()) 
            {
                 
                $name = Session::get('extensao')->id.date('Y_m_d_H_m_s');
         
                $extension = $request->image->extension();
         
                $nameFile = "{$name}.{$extension}";
         
                $upload = $request->image->storeAs('uploadEvetos', $nameFile);
         
                if ( !$upload )
                    return redirect()
                                ->back()
                                ->with('erro', 'Falha ao fazer upload')
                                ->withInput();
         
            }


            $evento = new Evento([
            	'titulo' => $request->get('titulo'),
    		    'descricao' => $request->get('descricao'),
    		    'data' => date('Y-m-d',strtotime($request->get('data'))),
    		    'horarioIn' => date('H:m:s',strtotime($request->get('horarioIn'))),
    		    'horarioFin' => date('H:m:s',strtotime($request->get('horarioFin'))),
    		    'local' => $request->get('local'),
    		    'qtdVagas' => $request->get('qtdVagas'),
                'imagem' => $nameFile,
    		    'idUsuarioCex' => Session::get('extensao')->id
            ]);

            try 
            {
            	$evento->save();

            	return redirect('evento/criar')->with('success','Evento salvo com sucesso!');
            } 
            catch (Exception $e) 
            {
            	return redirect('evento/criar')->with('erro','Erro ao criar evento!');
            }
            
        }
  
    }

    public function show($id)
    {
        $evento = DB::table('evento')
        ->where('evento.id',$id)
        ->join('usuariocex','evento.idUsuarioCex','=','usuariocex.id')
        ->select('evento.*','usuariocex.nome','usuariocex.sobrenome')
        ->first();


        if (DB::table('evento')->where('id',$id)->join('interesseevento','interesseevento.idEvento','=','evento.id')->exists())
        {
            $interesse = DB::table('evento')
            ->where('id',$id)
            ->join('interesseevento','interesseevento.idEvento','=','evento.id')
            ->get();

            $interesse = $interesse->count();

            return view('evento.show')->with(compact('evento'),('interesse'));
        }
        

        return view('evento.show')->with(compact('evento'));
    }

    public function edit($id)
    {
        if(Session::has('extensao'))
        {
            $evento = DB::table('evento')->where('id',$id)->first();
            return view('evento.evento-create')->with(compact('evento'));
        }
    }

    public function update(Request $request, $id)
    {
        if(Session::has('extensao'))
        {
            $this->validate($request, [
                'titulo' => 'required',
                'descricao' => 'required',
                'descricao' => 'required',
                'data' => 'required',
    		    'horarioIn' => 'required',
    		    'horarioFin' => 'required'
            ]);

            $evento = Evento::find($id);

            $evento->titulo = $request->get('titulo');
            $evento->descricao = $request->get('descricao');
            $evento->data = date('Y-m-d',strtotime($request->get('data')));
            $evento->horarioIn = date('H:m:s',strtotime($request->get('horarioIn')));
            $evento->horarioFin = date('H:m:s',strtotime($request->get('horarioFin')));
            $evento->local = $request->get('local');
    		$evento->qtdVagas = $request->get('qtdVagas');

    		try 
            {
            	$evento->save();

            	return redirect('evento/criar')->with('success','Evento alterado com sucesso!');
            } 
            catch (Exception $e) 
            {
            	return redirect('evento/criar')->with('erro','Erro ao criar evento!');
            }
        }
    }

    public function destroy($id)
    {
        if(Session::has('extensao'))
        {
            $evento = Evento::findOrFail($id);

            try
            {
                $evento->delete();
                return redirect()->route('evento.index')->with('success', 'Registro removido com sucesso!');
            }
            catch (\PDOException $e)
            {
                return redirect()->route('evento.index')->with('error', $e->getCode());
            } 
        }
    }
}
