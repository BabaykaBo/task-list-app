<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Task;
use App\Models\User;
use App\Models\Tag;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Requests\TaskRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;


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

        if ($request->filled('tags')) {
            $tags = explode(',', $request->tags);
            $tags = array_map('trim', $tags);
            $tags = array_unique($tags);


            if ($this->arrayTagsMaxLen($tags, 50)) {

                throw ValidationException::withMessages([
                    'tags' => ['Some tags are too long (no more 50 symbols)'],
                ]);
            }

            foreach ($tags as $tagName) {

                $tag = Tag::create(['text' => $tagName]);

                $task->tags()->attach($tag);
            }
        }
        return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Task was created successfully!');
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

        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));


            if ($this->arrayTagsMaxLen($tags, 50)) {
                throw ValidationException::withMessages([
                    'tags' => ['Some tags are too long (no more than 50 characters)'],
                ]);
            }

            $existingTags = $task->tags()->pluck('text', 'id')->toArray();

            $newTags = [];
            $existingTagIds = [];

            foreach ($tags as $tag) {

                if (!isset($existingTags[$tag])) {
                    $newTags[] = $tag;
                } else {
                    $existingTagIds[] = $existingTags[$tag];
                }
            }

            $task->tags()->sync($existingTagIds);

            foreach ($newTags as $newTag) {
                $tag = Tag::create(['text' => $newTag]);
                $existingTagIds[] = $tag->id;
            }

            $task->tags()->sync($existingTagIds);
        } else {

            $task->tags()->detach();
        }


        return redirect()->route('tasks.show', ['task' => $task])->with('success', 'Task was updated successfully!');

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

    private function arrayTagsMaxLen(array $array, int $number) {
        foreach ($array as $value) {
            if(strlen($value) >  $number) {
                return true;
            }
        }
        return false;
    }
}
