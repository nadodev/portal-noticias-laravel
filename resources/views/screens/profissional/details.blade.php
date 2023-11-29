<style>
    .profissional {
        display: flex;
        gap: 10px;
        font-family: sans-serif;
    }

    .profissional img {
        width: 300px;
        border: 2px solid #111;
    }

    .profissional__container {
        max-width: 600px;
        width: 100%;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Profissionais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($user)

                    <div class="profissional">
                        <div>
                            @if ($user->image)
                            <img src="{{ asset('storage/' .$user->image) }}" alt="Foto do Usuário">
                            @else
                            <p>Sem foto disponível.</p>
                            @endif
                        </div>
                        <div class="profissional__container">
                            <p>Nome: {{ $user->name }}</p>
                            <p>Ramo: {{ $user->ramo ?: 'Nenhum ramo especificado' }}</p>
                            <p>Descrição: {{ $user->description ?: 'Nenhuma descrição disponível' }}</p>

                            <hr />
                            <h2>Fale com o profissional: </h2>
                            <p>Cidade: {{ $user->city ?: 'Nenhuma cidade especificada' }} - {{ $user->state ?: 'Nenhum estado especificado' }}</p>
                            <p>Número de Telefone: {{ $user->number_phone ?: 'Nenhum número de telefone especificado' }}</p>
                            <p>Website: {{ $user->website ?: 'Nenhum website especificado' }}</p>
                            <p>Email: {{ $user->email }}</p>
                        </div>
                    </div>

                    @else
                    <p>Usuário não encontrado.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>