<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Pontos por Associado') }} 
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
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Associado</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Data</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Pontos</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if($pontosDistribuidos->isEmpty())
                            <p>Nenhum profissional encontrado.</p>
                            @else
                            @foreach($pontosDistribuidos as $index => $ponto)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">
                                    {{$ponto->associado->name }}
                                  
                                </td>
                                <td class="py-3 px-4">
                                    {{ $ponto->created_at }}
                                </td>
                                <td class="py-3 px-4">
                                    {{ $ponto->quantidade }}
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

