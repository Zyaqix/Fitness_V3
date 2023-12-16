<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // A middleware használatával biztosítjuk az admin jogosultságokat
    }

    public function index()
    {
        $tasks = Task::all();
        return view('admin.index', compact('tasks'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Feladat létrehozása
        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'bejegyezve',
            'availability' => true,
        ]);

        // Az összes felhasználó lekérése, akikhez rendelni kell a feladatot
        $users = User::where('role', '!=', 'admin')->get();

        // Feladat hozzárendelése minden felhasználóhoz
        foreach ($users as $user) {
            $user->tasks()->save($task);
        }

        return redirect('/admin')->with('success', 'Feladat létrehozva sikeresen!');
    }

    public function edit(Task $task)
    {
        return view('admin.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect('/admin')->with('success', 'Feladat módosítva sikeresen!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/admin')->with('success', 'Feladat törölve sikeresen!');
    }

    public function close(Task $task)
    {
        $task->update(['status' => 'lezarva']);
        return redirect('/admin')->with('success', 'Feladat lezárva sikeresen!');
    }

    public function search(Request $request)
    {
        $user = auth()->user();
        $keyword = $request->input('keyword');

        $tasks = $user->tasks()
            ->where('title', 'like', "%$keyword%")
            ->orWhere('start_date', 'like', "%$keyword%")
            ->orWhere('end_date', 'like', "%$keyword%")
            ->orWhere('status', 'like', "%$keyword%")
            ->get();

        return view('user.index', compact('tasks'));
    }
}