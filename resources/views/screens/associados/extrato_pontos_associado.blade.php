<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Extrato de Pontos de ') }} - {{ $associado->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <div class="flex items-center justify-between mb-6">
                        <p>Saldo de Pontos Disponíveis: {{ $saldoPontos }}</p>

                        <form action="{{ route('extrato.pontos.filtrado', ['id' => $associado->id]) }}" method="GET" class="flex gap-4 items-end">
                            <div>
                                <label for="data_inicio">Data de Início:</label>
                                <input type="datetime-local" id="data_inicio" name="data_inicio"    class="
                                        border-gray-300 
                                        w-full
                                        dark:border-gray-700 
                                        dark:bg-gray-900 
                                        dark:text-gray-300 
                                        focus:border-indigo-500 
                                        dark:focus:border-indigo-600 
                                        focus:ring-indigo-500 
                                        dark:focus:ring-indigo-600 
                                        rounded-md 
                                        shadow-sm">
                            </div>

                            <div>
                                <label for="data_fim">Data de Fim:</label>
                                <input type="datetime-local" id="data_fim" name="data_fim"    class="
                                        border-gray-300 
                                        w-full
                                        dark:border-gray-700 
                                        dark:bg-gray-900 
                                        dark:text-gray-300 
                                        focus:border-indigo-500 
                                        dark:focus:border-indigo-600 
                                        focus:ring-indigo-500 
                                        dark:focus:ring-indigo-600 
                                        rounded-md 
                                        shadow-sm">
                            </div>

                           <div class="h-14 flex items-end">
                           <x-primary-button>{{ __('Filtrar') }}</x-primary-button>
                           </div>
                        </form>
                   </div>
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">ID</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Data</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Profissional</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Pontos</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if($extratoPontos->isEmpty())
                                <tr class="bg-gray-50">
                                    <td class="py-3 px-4">
                                    </td>
                                    <td class="py-3 px-4">
                                    <p>Nenhum ponto encontrado para este associado neste intervalo de datas.</p>
                                    </td>
                                    <td class="py-3 px-4">
                                    </td>
                                </tr>
                                
                            @else
                            @foreach($extratoPontos as $index => $ponto)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="py-3 px-4"> {{ $associado->id }}</td>
                                <td class="py-3 px-4">
                                    {{ $ponto->created_at }}
                                </td>
                                <td class="py-3 px-4">
                                    {{ $ponto->profissional->name }}
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