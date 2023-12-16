<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feladatok') }}
        </h2>
    </x-slot>

    <form action="{{ route('user.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="Keresés...">
        <select name="status">
            <option value="">-- Állapot --</option>
            <option value="bejegyezve">Bejegyezve</option>
            <option value="folyamatban">Folyamatban</option>
            <option value="befejezve">Befejezve</option>
            <!-- További állapotok... -->
        </select>
        <input type="date" name="start_date" placeholder="Kezdés dátuma">
        <input type="date" name="end_date" placeholder="Befejezés dátuma">
        <button type="submit">Keresés</button>
    </form>

    <div>
        <div>
            <h3>Aktív feladatok</h3>
            <ul>
                @foreach ($tasks as $task)
                    @if ($task->status !== 'lezarva')
                        <li>
                            <strong>{{ $task->title }}</strong>
                            <br>
                            Leírás: {{ $task->description ?? 'Nincs leírás' }}
                            <br>
                            Kezdés: {{ $task->start_date }}
                            <br>
                            Befejezés: {{ $task->end_date }}
                            <br>
                            Állapot: {{ $task->status }}

                            <!-- Elfogadás gomb -->
                            @if ($task->status === 'bejegyezve')
                                <form action="{{ route('user.accept', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Elfogadás</button>
                                </form>
                            @endif

                            <!-- Befejezés gomb -->
                            @if ($task->status === 'folyamatban')
                                <form action="{{ route('user.complete', $task->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Befejezés</button>
                                </form>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div>
            <h3>Folyamatban lévő feladatok</h3>
            <ul>
                @foreach ($tasks as $task)
                    @if ($task->status === 'folyamatban')
                        <li>
                            <strong>{{ $task->title }}</strong>
                            <br>
                            Leírás: {{ $task->description ?? 'Nincs leírás' }}
                            <br>
                            Kezdés: {{ $task->start_date }}
                            <br>
                            Befejezés: {{ $task->end_date }}
                            <br>
                            Állapot: {{ $task->status }}
                        </li>
                    @endif
                @endforeach
            </ul>
    </div>
</x-app-layout>