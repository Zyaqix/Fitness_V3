<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feladatok') }}
        </h2>
    </x-slot>
    
    <form action="{{ route('admin.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="Keresés...">
        <select name="status">
            <option value="">-- Állapot --</option>
            <option value="bejegyezve">Bejegyezve</option>
            <option value="folyamatban">Folyamatban</option>
            <option value="befejezve">Befejezve</option>
            <option value="lezarva">Lezárva</option>
            <!-- További állapotok... -->
        </select>
        <input type="date" name="start_date" placeholder="Kezdés dátuma">
        <input type="date" name="end_date" placeholder="Befejezés dátuma">
        <button type="submit">Keresés</button>
    </form>

    <div>

    

        <ul>
            @forelse ($tasks as $task)
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

                    <!-- Lezárás gomb -->
                    @if ($task->status === 'befejezve')
                        <form method="POST" action="{{ route('admin.close', $task->id) }}">
                            @csrf
                            <button type="submit">Lezárás</button>
                        </form>
                    @endif

                    <!-- Módosítás gomb -->
                    <a href="{{ route('admin.edit', $task->id) }}">Módosítás</a>

                    <!-- Törlés gomb -->
                    @if ($task->status === 'bejegyezve')
                        <form action="{{ route('admin.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Törlés</button>
                        </form>
                    @endif
                </li>
            @empty
                <p>Nincsenek elérhető feladatok.</p>
            @endforelse
        </ul>
    </div>
</x-app-layout>