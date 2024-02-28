<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="mt-5">
        <div>
            <a class="font-medium text-gray-700 underline decoration-pink-500" href="{{ route('tasks.create') }}">
                Create New Task</a>
        </div>
        <div>
            @forelse ($tasks as $task)
                <div class="mb-1">
                    <a @class(['font-bold', 'line-through' => $task->completed]) href="{{ route('tasks.show', ['task' => $task]) }}"> *
                        {{ $task->title }}</a>
                </div>
            @empty
                <div>There are no tasks...</div>
            @endforelse

            @if ($tasks->count())
                <nav class="mt-4">{{ $tasks->links() }}</nav>
            @endif
        </div>

    </div>


</x-app-layout>
