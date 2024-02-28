<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Task;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Requests\TaskRequest;
use Illuminate\Auth\Access\AuthorizationException;


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
        $this->authUser(Auth::user(), $task);

        return view('tasks.show', ['task' => $task]);
    }

    public function complete(Task $task)
    {
        $this->authUser(Auth::user(), $task);

        $task->completed = !$task->completed;
        $task->save();

        return redirect()->back();
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();

        $task = new Task();

        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->user_id = Auth::user()->id;

        $task->save();

        return redirect()->route('tasks.show', ['task' => $task]);
    }

    public function edit(Task $task): View
    {
        $this->authUser(Auth::user(), $task);


        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Task $task, TaskRequest $request)
    {
        $this->authUser(Auth::user(), $task);

        $task->update($request->validated());

        return redirect()->route('tasks.show', ['task' => $task]);

    }

    public function destroy(Task $task)
    {
        $this->authUser(Auth::user(), $task);

        $task->delete();

        return redirect()->route('tasks.index');

    }

    private function authUser(User | Authenticatable $user,Task $task) {
        if ($user->id !== $task->user_id) {
            throw new AuthorizationException('You are not authorized to view this task.');
        }
    }
}
