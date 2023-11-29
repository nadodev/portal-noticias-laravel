

<h1>Lista de Pontos por Associado</h1>

<table>
    <thead>
        <tr>
            <th>Associado</th>
            <th>Data Recebimento</th>
            <th>Quantidade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pontosDistribuidos as $ponto)
            <tr>
                <td>{{ $ponto->associado->name }}</td>
                <td>{{ $ponto->created_at }}</td>
                <td>{{ $ponto->quantidade }}</td>
            </tr>
        @endforeach
    </tbody>
</table>