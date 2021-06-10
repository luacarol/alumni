<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mensagem;
use Illuminate\Support\Facades\Session;

class MensagemIndexController extends Controller
{
	public function index()
    {
        if(Session::has('extensao'))
        {

            $mensagens = DB::table('mensagemindex')
                    ->where('idCampus',Session::get('extensao')->idCampus)
                    ->orderBy('idCampus','desc')
                    ->get();

            return view('mensagem.mensagem-listar')->with(compact('mensagens'));
        }
    }

    public function send(Request $request)
    {
        $this->validate($request, [

        	'name' => 'required',
			'tel' => 'required',
			'email' => 'required',
			'subject' => 'required',
			'message' => 'required'
        ]);

        $mensagem = new Mensagem([
        	'nome' => $request->get('name'),
			'assunto' => $request->get('subject'),
			'mensagem' => $request->get('message'),
			'telefone' => $request->get('tel'),
			'email' => $request->get('email'),
			'idCampus' => $request->get('campus'),
			'data' => date('Y-m-d'),
			'status' => 'N'
        ]);

        try
        {
            $mensagem->save();

            return redirect('/#contact')->with('success','Mensagem enviada com sucesso!');
        }
        catch (Exception $e)
        {
            return redirect('/#contact')->with('erro','Erro ao enviar mensagem!');
        }
    }

    public function show($id)
    {
        $mensagem = Mensagem::find($id);

    	$mensagem->status = 'V';
        $mensagem->visualizadoPor = Session::get('extensao')->id;

    	$mensagem->save();

        return view('mensagem.read')->with(compact('mensagem'));
    }
}
