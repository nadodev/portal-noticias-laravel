<!-- Exemplo na sua view de extrato de pontos do associado -->

<!-- Seu HTML -->

<form action="{{ route('extrato.pontos.filtrado', ['id' => $associado->id]) }}" method="GET">
    <label for="data_inicio">Data de Início:</label>
    <input type="datetime-local" id="data_inicio" name="data_inicio">

    <label for="data_fim">Data de Fim:</label>
    <input type="datetime-local" id="data_fim" name="data_fim">

    <button type="submit">Filtrar</button>
</form>


@if($extratoPontos->isEmpty())
    <p>Nenhum ponto encontrado para este associado neste intervalo de datas.</p>
@else
    <h2>Extrato de Pontos para o Intervalo de Datas Selecionado</h2>
    <ul>
        @foreach($extratoPontos as $ponto)
            <li>
                Data: {{ $ponto->created_at }} - Quantidade: {{ $ponto->quantidade }}
            </li>
        @endforeach
    </ul>
@endif
