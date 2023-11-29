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
            {{ __('Lista de Associados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">ID</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Nome</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">E-mail</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Ramo</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Data de Criação</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if($associados->isEmpty())
                            <p>Nenhum profissional encontrado.</p>
                            @else
                            @foreach($associados as $index => $associado)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="py-3 px-4"> {{ $associado->id }}</td>
                                <td class="py-3 px-4">
                                    {{ $associado->name }}
                                </td>
                                <td class="py-3 px-4">
                                    {{ $associado->email }}
                                </td>
                                <td class="py-3 px-4">
                                    {{ $associado->ramo }}
                                </td>
                                <td class="py-3 px-4">
                                    {{ $associado->created_at }}
                                </td>
                                <td class="py-3 px-4">
                                    <a href="/associados/{{ $associado->id }}/extrato">
                                        Ver Extrato
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>