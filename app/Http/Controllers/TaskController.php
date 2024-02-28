<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Task;


class TaskController extends Controller
{
    public function index(): View
    {
        return view('tasks.index');
    }
}
