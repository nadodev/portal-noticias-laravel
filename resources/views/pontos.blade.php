<!-- Exemplo na sua view -->
<h1>Detalhes do Profissional</h1>
@if(isset($profissional))
    <p>Nome: {{ $profissional->name }}</p>
    <p>Email: {{ $profissional->email }}</p>
    <p>Pontos Recebidos: {{ $pontosRecebidos }}</p>
@else
    <p>Profissional não encontrado.</p>
@endif