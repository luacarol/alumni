<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $campus = DB::table('campus')
        ->select('campus.id','campus.sigla')
        ->get();

        $noticias = DB::table('noticia')
        ->select('titulo','id','lide')
        ->latest('data')
        ->where('lide','!=','')
        ->limit(4)
        ->get();

        return view('welcome')->with(compact(('campus'),('noticias')));
    }
}
