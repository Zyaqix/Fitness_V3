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
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tasksQuery = Task::query();

        if ($keyword) {
            $tasksQuery->where('title', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
        }

        if ($status) {
            $tasksQuery->orWhere('status', $status);
        }

        if ($startDate) {
            $tasksQuery->whereDate('start_date', '>=', $startDate);
        }

        if ($endDate) {
            $tasksQuery->whereDate('end_date', '<=', $endDate);
        }

        $tasks = $tasksQuery->get();

        return view('user.index', compact('tasks'));
    }
}