<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tasks = $user->tasks();
        return view('user.index', compact('tasks'));
    }

    public function accept(Task $task)
    {
        $task->update(['status' => 'folyamatban']);
        return redirect('/user')->with('success', 'Feladat elfogadva sikeresen!');
    }

    public function complete(Task $task)
    {
        $task->update(['status' => 'befejezve']);
        return redirect('/user')->with('success', 'Feladat befejezve sikeresen!');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $tasks = Task::where('title', 'like', "%$keyword%")
            ->orWhere('start_date', 'like', "%$keyword%")
            ->orWhere('end_date', 'like', "%$keyword%")
            ->orWhere('status', 'like', "%$keyword%")
            ->get();

        return view('user.index', compact('tasks'));
    }
}