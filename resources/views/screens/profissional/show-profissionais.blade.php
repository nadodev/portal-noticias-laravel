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
                    <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">ID</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Nome</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Ramo</th>
                                <th class="text-left py-3 px-4 uppercase font-bold text-gray-700">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($profissionais as $index => $profissional)
                            <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">
                                        {{ $profissional->name }}
                                </td>
                                <td class="py-3 px-4">
                                        {{ $profissional->ramo }}
                                </td>
                                <td class="py-3 px-4">
                                    <a class="text-blue-500 hover:underline" href="{{ route('pontos.recebidos', ['id' => $profissional->id]) }}">
                                       Ver
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>