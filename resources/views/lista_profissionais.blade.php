<h1>Lista de Profissionais</h1>

<ul>
    @foreach($profissionais as $profissional)
        <li><a href="{{ route('pontos.recebidos', ['id' => $profissional->id]) }}">{{ $profissional->name }}</a></li>
    @endforeach
</ul>
