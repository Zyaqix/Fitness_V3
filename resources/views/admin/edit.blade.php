<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feladat Szerkesztése') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.update', $task->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Cím -->
                        <div class="mt-4">
                            <x-label for="title" :value="__('Cím')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $task->title)" required autofocus />
                        </div>

                        <!-- Leírás -->
                        <div class="mt-4">
                            <x-label for="description" :value="__('Leírás')" />
                            <x-input id="description" class="block mt-1 w-full" name="description" :value="old('description', $task->description)" />
                        </div>

                        <!-- Státusz -->
                        <div class="mt-4">
                            <x-label for="status" :value="__('Állapot')" />
                            <select id="status" name="status" class="block mt-1 w-full">
                                <option value="bejegyezve" {{ old('status', $task->status) === 'bejegyezve' ? 'selected' : '' }}>Bejegyezve</option>
                                <option value="folyamatban" {{ old('status', $task->status) === 'folyamatban' ? 'selected' : '' }}>Folyamatban</option>
                                <option value="befejezve" {{ old('status', $task->status) === 'befejezve' ? 'selected' : '' }}>Befejezve</option>
                                <option value="lezarva" {{ old('status', $task->status) === 'lezarva' ? 'selected' : '' }}>Lezárva</option>
                            </select>
                        </div>

                        <!-- Kezdési dátum -->
                        <div class="mt-4">
                            <x-label for="start_date" :value="__('Kezdési dátum')" />
                            <x-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date', \Carbon\Carbon::parse($task->start_date)->format('Y-m-d'))" required />
                        </div>

                        <!-- Befejezési dátum -->
                        <div class="mt-4">
                            <x-label for="end_date" :value="__('Befejezési dátum')" />
                            <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date', \Carbon\Carbon::parse($task->end_date)->format('Y-m-d'))" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button>
                                {{ __('Mentés') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>