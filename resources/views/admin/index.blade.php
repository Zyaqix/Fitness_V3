<x-app-layout>

    <x-slot name="header">
        <h2 style="font-size: 1.5rem; font-weight: bold; color: #333; margin: 0;">
            Feladatok
        </h2>
    </x-slot>
    
    <form action="{{ route('admin.search') }}" method="GET" style="margin-top: 1rem;">
        <input type="text" name="keyword" placeholder="Keresés..." style="padding: 0.5rem;">
        <select name="status" style="padding: 0.5rem;">
            <option value=""> Állapot </option>
            <option value="bejegyezve">Bejegyezve</option>
            <option value="folyamatban">Folyamatban</option>
            <option value="befejezve">Befejezve</option>
            <option value="lezarva">Lezárva</option>
        </select>
        <input type="date" name="start_date" placeholder="Kezdés dátuma" style="padding: 0.5rem;">
        <input type="date" name="end_date" placeholder="Befejezés dátuma" style="padding: 0.5rem;">
        <button type="submit" style="padding: 0.5rem; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Keresés</button>
    </form>

    <div style="margin-top: 1.5rem;">
        <div>
            <h3 style="font-size: 1.2rem; font-weight: bold; color: #333;">Aktív feladatok</h3>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($tasks as $task)
                    @if ($task->status === 'bejegyezve')
                        <li style="margin-bottom: 1rem; border: 1px solid #ddd; padding: 1rem;">
                            <strong>{{ $task->title }}</strong><br>
                            Leírás: {{ $task->description ?? 'Nincs leírás' }}<br>
                            Kezdés: {{ $task->start_date }}<br>
                            Befejezés: {{ $task->end_date }}<br>
                            Állapot: {{ $task->status }}
    
                            <a href="{{ route('admin.edit', $task->id) }}" style="margin-right: 1rem; text-decoration: none; color: #007bff;">Módosítás</a>
    
                            <form action="{{ route('admin.destroy', $task->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 0.25rem; background-color: #dc3545; color: #fff; border: none; cursor: pointer;">Törlés</button>
                            </form>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    
        <div>
            <h3 style="font-size: 1.2rem; font-weight: bold; color: #333;">Folyamatban lévő feladatok</h3>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($tasks as $task)
                    @if ($task->status === 'folyamatban')
                        <li style="margin-bottom: 1rem; border: 1px solid #ddd; padding: 1rem;">
                            <strong>{{ $task->title }}</strong><br>
                            Leírás: {{ $task->description ?? 'Nincs leírás' }}<br>
                            Kezdés: {{ $task->start_date }}<br>
                            Befejezés: {{ $task->end_date }}<br>
                            Állapot: {{ $task->status }}
    
                            <a href="{{ route('admin.edit', $task->id) }}" style="margin-right: 1rem; text-decoration: none; color: #007bff;">Módosítás</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    
        <div>
            <h3 style="font-size: 1.2rem; font-weight: bold; color: #333;">Befejezett feladatok</h3>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($tasks as $task)
                    @if ($task->status === 'befejezve')
                        <li style="margin-bottom: 1rem; border: 1px solid #ddd; padding: 1rem;">
                            <strong>{{ $task->title }}</strong><br>
                            Leírás: {{ $task->description ?? 'Nincs leírás' }}<br>
                            Kezdés: {{ $task->start_date }}<br>
                            Befejezés: {{ $task->end_date }}<br>
                            Állapot: {{ $task->status }}
    
                            <a href="{{ route('admin.edit', $task->id) }}" style="margin-right: 1rem; text-decoration: none; color: #007bff;">Módosítás</a>
    
                            <form method="POST" action="{{ route('admin.close', $task->id) }}" style="display: inline;">
                                @csrf
                                <button type="submit" style="padding: 0.25rem; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Lezárás</button>
                            </form>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    
        <div>
            <h3 style="font-size: 1.2rem; font-weight: bold; color: #333;">Lezárt feladatok</h3>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                @foreach ($tasks as $task)
                    @if ($task->status === 'lezarva')
                        <li style="margin-bottom: 1rem; border: 1px solid #ddd; padding: 1rem;">
                            <strong>{{ $task->title }}</strong><br>
                            Leírás: {{ $task->description ?? 'Nincs leírás' }}<br>
                            Kezdés: {{ $task->start_date }}<br>
                            Befejezés: {{ $task->end_date }}<br>
                            Állapot: {{ $task->status }}
    
                            <a href="{{ route('admin.edit', $task->id) }}" style="margin-right: 1rem; text-decoration: none; color: #007bff;">Módosítás</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>