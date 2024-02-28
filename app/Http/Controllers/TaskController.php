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
}
