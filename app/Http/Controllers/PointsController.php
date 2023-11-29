<?php

namespace App\Http\Controllers;

use App\Models\PontosDistribuido;
use App\Models\PontosIniciaisAssociado;
use App\Models\PontosRecebido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PointsController extends Controller
{
    
    public function showProfessionalRanking()
    {
        $professionals = User::where('role', 'profissional')
            ->withCount(['pontosRecebidos as total_pontos' => function ($query) {
                $query->select(DB::raw('COALESCE(SUM(quantidade), 0)'));
            }])
            ->orderByDesc('total_pontos')
            ->get();

        return view('screens.rank', compact('professionals'));
    }

    
    public function mostrarProfissionalEPontos($id)
    {
        $profissional = User::find($id);

        if (!$profissional || $profissional->role !== 'profissional') {
            return redirect()->back()->with('error', 'Profissional não encontrado.');
        }

        $pontosRecebidos = PontosRecebido::where('profissional_id', $id)->sum('quantidade');

        return view('sua_view', compact('profissional', 'pontosRecebidos'));
    }


    public function mostrarFormulario()
    {
        $profissionais = User::where('role', 'profissional')->get();

        return view('screens.pontos', compact('profissionais'));
    }

    public function distribuirPontos(Request $request)
    {
        $associadoId = Auth::id();
        $pontosIniciais = PontosIniciaisAssociado::where('associado_id', $associadoId)->firstOrFail();
    
        if ($pontosIniciais->pontos_iniciais < $request->quantidade_pontos || empty($request->profissional_id)) {
            throw ValidationException::withMessages([
                'error' => 'Pontos insuficientes para distribuição ou profissional não especificado.',
            ]);
        }
    
        $profissional = User::find($request->profissional_id);
    
        if (!$profissional || $profissional->role !== 'profissional') {
            throw ValidationException::withMessages([
                'error' => 'Profissional não encontrado ou inválido.',
            ]);
        }
    
        try {
            DB::beginTransaction();
    
            PontosDistribuido::create([
                'associado_id' => $associadoId,
                'profissional_id' => $request->profissional_id,
                'quantidade' => $request->quantidade_pontos,
            ]);
    
            PontosRecebido::create([
                'profissional_id' => $request->profissional_id,
                'quantidade' => $request->quantidade_pontos,
            ]);
    
            $pontosIniciais->decrement('pontos_iniciais', $request->quantidade_pontos);
    
            DB::commit();
    
            return redirect('/rank')->with('success', 'Pontos distribuídos com sucesso!');
        } catch (\Illuminate\Validation\ValidationException  $e) {
            DB::rollBack();
            $errors = $e->validator->getMessageBag()->all();
            return redirect()->back()->with( 'errors', $errors);
        }
    }


}
