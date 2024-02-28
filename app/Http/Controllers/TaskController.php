<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Task;
use Auth;


class TaskController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $tasks = $user->tasks()->paginate(10);

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function show(Task $task): View
    {
        return view('tasks.show', ['task' => $task]);
    }

    public function complete(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();

        return redirect()->back();
    }
}
