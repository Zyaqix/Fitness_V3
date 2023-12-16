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
        $user = auth()->user();
        $keyword = $request->input('keyword');
        $status = $request->input('status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tasks = $user->tasks()
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%");
            })
            ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
             })
            ->when($startDate, function ($query) use ($startDate) {
            $query->whereDate('start_date', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
            $query->whereDate('end_date', '<=', $endDate);
            })
            ->get();
        return view('user.index', compact('tasks'));
    }
}