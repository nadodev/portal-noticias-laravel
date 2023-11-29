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
                    @if ($users->isEmpty())
                    <p>Nenhum usuário encontrado.</p>
                    @else
                        <ul>
                            @foreach ($users as $user)
                            <li>
                                <a class="bg-zinc-100 block px-2" href="{{ route('profissional.details', ['id' => $user->id, 'nome_profissional' => $user->name]) }}">
                                    {{ $user->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>