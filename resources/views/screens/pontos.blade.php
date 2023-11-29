<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('pontos.store') }}" method="POST">
                        @csrf
                       <div>
                            <label for="profissional" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Selecione o profissional:</label>
                            <select name="profissional_id" 
                                    id="profissional" 
                                    class="
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
                                @foreach($profissionais as $profissional)
                                <option value="{{ $profissional->id }}">{{ $profissional->name }}</option>
                                @endforeach
                            </select>
                       </div>
                        <br>
                        
                        <div>
                            <x-input-label for="quantidade_pontos" :value="__('Quantidade de pontos')" />
                            <x-text-input id="quantidade_pontos" name="quantidade_pontos" type="text" class="mt-1 block w-full" required autofocus autocomplete="quantidade_pontos" />
                            <x-input-error class="mt-2" :messages="$errors->get('quantidade_pontos')" />
                        </div>
                        <br>
                        <x-primary-button>{{ __('Adicionar Pontos') }}</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>