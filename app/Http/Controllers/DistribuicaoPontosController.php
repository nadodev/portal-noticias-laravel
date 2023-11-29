<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PontosDistribuido;
use App\Models\PontosIniciaisAssociado;
use App\Models\PontosRecebido;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistribuicaoPontosController extends Controller
{
    public function mostrarFormulario()
    {
        $profissionais = User::where('role', 'profissional')->get();

        return view('form_distribuicao_pontos', compact('profissionais'));
    }

    public function distribuirPontos(Request $request)
    {
        // Obtenha o ID do associado logado ou o ID do associado que está distribuindo os pontos
        $associadoId = Auth::id();
        

        // Verifique se o associado possui pontos suficientes para distribuir
        $pontosIniciais = PontosIniciaisAssociado::where('associado_id', $associadoId)->firstOrFail();
        if ($pontosIniciais->pontos_iniciais < $request->quantidade_pontos) {
            return redirect()->back()->with('error', 'Pontos insuficientes para distribuição.');
        }

        // Registre a distribuição de pontos para o profissional correspondente
        PontosDistribuido::create([
            'associado_id' => $associadoId,
            'profissional_id' => $request->profissional_id,
            'quantidade' => $request->quantidade_pontos,
        ]);

        // Registre os pontos recebidos pelo profissional
        PontosRecebido::create([
            'profissional_id' => $request->profissional_id,
            'quantidade' => $request->quantidade_pontos,
        ]);

        return redirect('/rank')->with('success', 'Pontos distribuídos com sucesso!');
    }


    public function mostrarProfissionalEPontos($id)
    {
        // Encontre o profissional pelo ID
        $profissional = User::find($id);

        if (!$profissional || $profissional->role !== 'profissional') {
            // Trate o caso em que o usuário não é um profissional ou não existe
            return redirect()->back()->with('error', 'Profissional não encontrado.');
        }

        // Obtenha os pontos recebidos pelo profissional
        $pontosRecebidos = PontosRecebido::where('profissional_id', $id)->sum('quantidade');

        return view('sua_view', compact('profissional', 'pontosRecebidos'));
    }

    public function mostrarRankProfissionais()
    {
        // Obtenha todos os profissionais e a soma de pontos recebidos por cada um
        $profissionais = User::where('role', 'profissional')
            ->withCount(['pontosRecebidos as total_pontos' => function ($query) {
                $query->select(DB::raw('COALESCE(SUM(quantidade), 0)'));
            }])
            ->orderByDesc('total_pontos')
            ->get();

        return view('rank', compact('profissionais'));
    }





    public function listarAssociados()
    {
        // Obtenha todos os associados
        $associados = User::where('role', 'associado')->get();

        return view('lista_associados', compact('associados'));
    }

    public function extratoPontos($id)
    {

        $associadoId = Auth::id();
        // Encontre o associado pelo ID
        $associado = User::findOrFail($id);

        // Obtenha os pontos iniciais do associado
        $pontosIniciais = PontosIniciaisAssociado::where('associado_id', $id)->firstOrFail();

        // Calcule a quantidade total de pontos distribuídos para o associado
        $pontosDistribuidos = PontosDistribuido::where('associado_id', $id)->sum('quantidade');

        // Calcule o saldo de pontos disponíveis (Pontos Iniciais - Pontos Distribuídos)
        $saldoPontos = $pontosIniciais->pontos_iniciais - $pontosDistribuidos;

        // Obtendo o extrato de pontos distribuídos pelo associado
        $extratoPontos = PontosDistribuido::where('associado_id', $id)->get();

        return view('extrato_pontos_associado', compact('associado', 'extratoPontos', 'saldoPontos'));
    }


    public function formularioAdicaoPontos($id)
    {
        $associado = User::findOrFail($id);
        return view('formulario_adicao_pontos', compact('associado'));
    }


    public function extratoPontosFiltrado(Request $request, $id)
    {
        // Obter os valores do formulário
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        // Converter os valores para objetos Carbon para utilizar na consulta
        $dataInicio = Carbon::parse($dataInicio);
        $dataFim = Carbon::parse($dataFim);

        // Consulta ao banco de dados filtrando pelo intervalo de datas
        $extratoPontos = PontosDistribuido::where('associado_id', $id)
            ->whereBetween('created_at', [$dataInicio, $dataFim])
            ->get();

        // Obter os dados do associado para passar para a view
        $associado = User::findOrFail($id);

        // Obter o saldo de pontos disponíveis do associado
        $pontosIniciais = PontosIniciaisAssociado::where('associado_id', $id)->firstOrFail();
        $pontosDistribuidos = PontosDistribuido::where('associado_id', $id)
            ->whereBetween('created_at', [$dataInicio, $dataFim])
            ->sum('quantidade');
        $saldoPontos = $pontosIniciais->pontos_iniciais - $pontosDistribuidos;

        return view('extrato_pontos_associado', compact('extratoPontos', 'associado', 'saldoPontos'));
    }


    public function pontosRecebidosProfissional($id)
    {
        $pontosDistribuidos = PontosDistribuido::where('profissional_id', $id)
        ->with('associado')
        ->get();

    
        return view('pontos_recebidos_profissional',compact('pontosDistribuidos'));
    }

    public function listarProfissionais()
    {
        $profissionais = User::where('role', 'profissional')->get();

        return view('lista_profissionais', compact('profissionais'));
    }


    public function listaPontosPorAssociado()
    {
        $pontosDistribuidos = PontosDistribuido::with('associado')
            ->orderBy('created_at') // Ordene os pontos por data, se desejar
            ->get();
    
        return view('lista_pontos_por_associado', compact('pontosDistribuidos'));
    }

    public function agruparPontos(Request $request)
    {
        $pontosDistribuidos = PontosDistribuido::with('associado')
        ->orderBy('created_at') // Ordene os pontos por data, se desejar
        ->get();

        $pontosAgrupados = [];
        foreach ($pontosDistribuidos as $ponto) {
            $associadoId = $ponto->associado_id;
            $quantidade = $ponto->quantidade;

            if (!isset($pontosAgrupados[$associadoId])) {
                $pontosAgrupados[$associadoId] = [
                    'associado' => $ponto->associado->name,
                    'total_pontos' => 0,
                ];
            }

            $pontosAgrupados[$associadoId]['total_pontos'] += $quantidade;
        }

        dd($pontosDistribuidos);

        // Retornar a mesma view, mas passando os dados agrupados
        return view('lista_pontos_por_associado', compact('pontosAgrupados'));
    }
}
