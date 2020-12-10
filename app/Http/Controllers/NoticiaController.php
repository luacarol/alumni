<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NoticiaController extends Controller
{
    public function index()
    {
        if(Session::has('extensao'))
        {

            $noticias = DB::table('noticia')
                    ->whereIn('idUsuarioCex',DB::table('usuariocex')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->select('id'))
                    ->orderBy('id','desc')
                    ->get();

            return view('noticia.noticia-listar')->with(compact('noticias'));
        }

        if(Session::has('aluno'))
        {

            $noticias = DB::table('noticia')
                ->whereIn('idUsuarioCex',DB::table('usuariocex')
                    ->whereIn('usuariocex.idCampus',DB::table('matricula')
                        ->where('cpfAluno',Session::get('aluno')->cpf)
                        ->select('matricula.idCampus')
                    )->select('id'))
                ->get();
                
            return view('noticia.noticia-listar-aluno')->with(compact(('noticias')));
        }

        //return view('noticia.index');
    }

    public function create()
    {
        return view('noticia.noticia-create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required',
            'desc' => 'required'
        ]);

        $nameFile = null;
     
        if ($request->hasFile('image') && $request->file('image')->isValid()) 
        {
             
            $name = Session::get('extensao')->id.date('Y_m_d_H_m_s');
     
            $extension = $request->image->extension();
     
            $nameFile = "{$name}.{$extension}";
     
            $upload = $request->image->storeAs('uploadNoticias', $nameFile);
     
            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('erro', 'Falha ao fazer upload')
                            ->withInput();
     
        }

        $noticia = new Noticia([
            'titulo' => $request->get('titulo'),
            'texto' => $request->get('desc'),
            'data' => date('Y-m-d'),
            'lide' => $request->get('lide'),
            'imagem' => $nameFile,
            'idUsuarioCex' => Session::get('extensao')->id
        ]);

        try 
        {
            $noticia->save();

            return redirect('noticia/criar')->with('success','Noticia salva com sucesso!');
        } 
        catch (Exception $e) 
        {
            return redirect('noticia/criar')->with('erro','Erro ao salvar noticia!');
        }       
  
    }

    public function show($id)
    {
        $noticia = DB::table('noticia')
        ->where('noticia.id',$id)
        ->join('usuariocex','noticia.idUsuarioCex','=','usuariocex.id')
        ->select('usuariocex.nome','usuariocex.sobrenome','noticia.*')
        ->first();
        return view('noticia.readExt')->with(compact('noticia'));
    }
    /*public function show($id)
    {
       
    }*/

    public function edit($id)
    {
        $noticia = DB::table('noticia')->where('id',$id)->first();
        return view('noticia.noticia-create')->with(compact('noticia'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo' => 'required',
            'desc' => 'required'
        ]);

        $noticia = Noticia::find($id);

        $noticia->titulo = $request->get('titulo');
        $noticia->lide = $request->get('lide');
        $noticia->texto = $request->get('desc');

        try 
        {
            $noticia->save();

            return redirect('noticia/criar')->with('success','Noticia salva com sucesso!');
        } 
        catch (Exception $e) 
        {
            return redirect('noticia/criar')->with('erro','Erro ao criar evento!');
        }
    }

    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);

        try
        {
            $noticia->delete();
            return redirect()->route('noticia.index')->with('success', 'Registro removido com sucesso!');
        }
        catch (\PDOException $e)
        {
            return redirect()->route('noticia.index')->with('error', $e->getCode());
        } 
    }
}
