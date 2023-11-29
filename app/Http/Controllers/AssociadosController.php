<?php

namespace App\Http\Controllers;

use App\Models\PontosDistribuido;
use App\Models\PontosIniciaisAssociado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssociadosController extends Controller
{
    public function listarAssociados()
    {
        // Obtenha todos os associados
        $associados = User::where('role', 'associado')->get();


        return view('screens.associados.list', compact('associados'));
    }

    public function extratoPontos($id)
    {

        $associadoId = Auth::id();
        $associado = User::findOrFail($id);

        $pontosIniciais = PontosIniciaisAssociado::where('associado_id', $id)->firstOrFail();

        $pontosDistribuidos = PontosDistribuido::where('associado_id', $id)->sum('quantidade');

        $saldoPontos = $pontosIniciais->pontos_iniciais - $pontosDistribuidos;

        $extratoPontos = PontosDistribuido::where('associado_id', $id)->get();

        return view('screens.associados.extrato_pontos_associado', compact('associado', 'extratoPontos', 'saldoPontos'));
    }

    public function extratoPontosFiltrado(Request $request, $id)
    {
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        $dataInicio = Carbon::parse($dataInicio);
        $dataFim = Carbon::parse($dataFim);

        $extratoPontos = PontosDistribuido::where('associado_id', $id)
            ->whereBetween('created_at', [$dataInicio, $dataFim])
            ->get();

        $associado = User::findOrFail($id);

        $pontosIniciais = PontosIniciaisAssociado::where('associado_id', $id)->firstOrFail();
        $pontosDistribuidos = PontosDistribuido::where('associado_id', $id)
            ->whereBetween('created_at', [$dataInicio, $dataFim])
            ->sum('quantidade');
        $saldoPontos = $pontosIniciais->pontos_iniciais - $pontosDistribuidos;

        return view('screens.associados.extrato_pontos_associado', compact('extratoPontos', 'associado', 'saldoPontos'));
    }
}
