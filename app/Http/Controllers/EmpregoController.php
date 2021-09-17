<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emprego;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class EmpregoController extends Controller
{
    public function index()
    {

        if(Session::has('extensao'))
        {

            $empregos = DB::table('emprego')
                    ->whereIn('idUsuarioCex',DB::table('usuariocex')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->select('id'))
                    ->orderBy('id', 'asc')
                    ->get();

            return view('emprego.emprego-listar')->with(compact('empregos'));
        }
        if(Session::has('aluno'))
        {
            $empregos = DB::table('emprego')
                ->whereIn('idUsuarioCex',DB::table('usuariocex')
                    ->whereIn('usuariocex.idCampus',DB::table('matricula')
                        ->where('cpfAluno',Session::get('aluno')->cpf)
                        ->select('matricula.idCampus')
                    )->select('id'))
                ->leftJoin('interesseemprego','interesseemprego.idEmprego','=','emprego.id')
                ->select('emprego.*','interesseemprego.cpfAluno as interessados')
                ->orderBy('dataPublicacao', 'asc')
                ->get();

            return view('emprego.emprego-listar-aluno')->with(compact(('empregos')));
        }
    }

    public function create()
    {
        if(Session::has('extensao'))
            return view('emprego.emprego-create');
    }

    public function store(Request $request)
    {
        if(Session::has('extensao'))
        {
            $this->validate($request, [
                'nomeVaga' => 'required',
                'salario' => 'required',
                'preRequisitos' => 'required',
                'atividadeVaga' => 'required',
    		    'local' => 'required',
                'horario' => 'required',
                'dataPublicacao' => 'required',
                'qtdVagas' => 'required'
            ]);

            $nameFile = null;

            if ($request->hasFile('image') && $request->file('image')->isValid())
            {
                $name = Session::get('extensao')->id.date('Y_m_d_H_m_s');

                $extension = $request->image->extension();

                $nameFile = "{$name}.{$extension}";

                $upload = $request->image->storeAs('uploadEmpregos', $nameFile);

                if ( !$upload )
                    return redirect()
                                ->back()
                                ->with('erro', 'Falha ao fazer upload')
                                ->withInput();

            }


            $emprego = new Emprego([
            	'nomeVaga' => $request->get('nomeVaga'),
                'salario' => $request->get('salario'),
    		    'preRequisitos' => $request->get('preRequisitos'),
                'atividadeVaga' => $request->get('atividadeVaga'),
                'local' => $request->get('local'),
                'horario' => $request->get('horario'),
    		    'dataPublicacao' => date('Y-m-d',strtotime($request->get('dataPublicacao'))),
    		    'qtdVagas' => $request->get('qtdVagas'),
                'imagem' => $nameFile,
    		    'idUsuarioCex' => Session::get('extensao')->id
            ]);

            try
            {
            	$emprego->save();

            	return redirect('emprego/criar')->with('success','Emprego salvo com sucesso!');
            }
            catch (Exception $e)
            {
            	return redirect('emprego/criar')->with('erro','Erro ao criar emprego!');
            }

        }

    }

    public function show($id)
    {
        $emprego = DB::table('emprego')
        ->where('emprego.id',$id)
        ->join('usuariocex','emprego.idUsuarioCex','=','usuariocex.id')
        ->select('emprego.*','usuariocex.nome','usuariocex.sobrenome')
        ->first();


        if (DB::table('emprego')->where('id',$id)->join('interesseemprego','interesseemprego.idEmprego','=','emprego.id')->exists())
        {
            $interesse = DB::table('emprego')
            ->where('id',$id)
            ->join('interesseemprego','interesseemprego.idEmprego','=','emprego.id')
            ->get();

            $interesse = $interesse->count();

            return view('emprego.show')->with(compact('emprego'),('interesse'));
        }


        return view('emprego.show')->with(compact('emprego'));
    }

    public function edit($id)
    {
        if(Session::has('extensao'))
        {
            $emprego = DB::table('emprego')->where('id',$id)->first();
            return view('emprego.emprego-create')->with(compact('emprego'));
        }
    }

    public function update(Request $request, $id)
    {
        if(Session::has('extensao'))
        {
            $this->validate($request, [
                'nomeVaga' => 'required',
                'salario' => 'required',
                'preRequisitos' => 'required',
                'atividadeVaga' => 'required',
                'local' => 'required',
                'horario' => 'required',
                'dataPublicacao' => 'required',
    		    'qtdVagas' => 'required'
            ]);

            $emprego = Emprego::find($id);

            $emprego->nomeVaga = $request->get('nomeVaga');
            $emprego->salario = $request->get('salario');
            $emprego->preRequisitos = $request->get('preRequisitos');
            $emprego->atividadeVaga = $request->get('atividadesVaga');
            $emprego->local = $request->get('local');
            $emprego->horario = $request->get('horario');
            $emprego->dataPublicacao = date('Y-m-d',strtotime($request->get('dataPublicacao')));
            $emprego->qtdVagas = $request->get('qtdVagas');

    		try
            {
            	$emprego->save();

            	return redirect('emprego/criar')->with('success','Emprego alterado com sucesso!');
            }
            catch (Exception $e)
            {
            	return redirect('emprego/criar')->with('erro','Erro ao criar emprego!');
            }
        }
    }

    public function destroy($id)
    {
        if(Session::has('extensao'))
        {
            $emprego = Emprego::findOrFail($id);

            try
            {
                $emprego->delete();
                return redirect()->route('emprego.index')->with('success', 'Registro removido com sucesso!');
            }
            catch (\PDOException $e)
            {
                return redirect()->route('emprego.index')->with('error', $e->getCode());
            }
        }
    }
}
