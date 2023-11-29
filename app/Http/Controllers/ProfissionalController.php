<?php

namespace App\Http\Controllers;

use App\Models\PontosDistribuido;
use App\Models\User;
use Illuminate\Http\Request;

class ProfissionalController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('screens.profissional.list', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('screens.profissional.details', compact('user'));
    }

    public function ShowPointsProfissionais()
    {
        $profissionais = User::where('role', 'profissional')->get();

        return view('screens.profissional.show-profissionais', compact('profissionais'));
    }

    public function pontosRecebidosProfissional($id)
    {
        $pontosDistribuidos = PontosDistribuido::where('profissional_id', $id)
        ->with('associado')
        ->get();

    
        return view('screens.profissional.pontos_recebidos_profissional',compact('pontosDistribuidos'));
    }

    
    public function listaPontosPorAssociado()
    {
        $pontosDistribuidos = PontosDistribuido::with('associado')
            ->orderBy('created_at') 
            ->get();
    
        return view('lista_pontos_por_associado', compact('pontosDistribuidos'));
    }
    
}
