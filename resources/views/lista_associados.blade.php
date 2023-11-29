<!-- Exemplo na sua view de lista de associados -->
<h1>Lista de Associados</h1>
<ul>
    @foreach($associados as $associado)
        <li>
            <a href="/associados/{{ $associado->id }}/extrato">
                {{ $associado->name }}
            </a>
        </li>
    @endforeach
</ul>