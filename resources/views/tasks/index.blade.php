<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div>
        @forelse ($tasks as $task)
            <div>
                <a @class(['font-bold', 'line-through' => $task->completed])
                    href="{{ route('tasks.show', ['task' => $task]) }}">{{ $task->title }}</a>
            </div>
        @empty
            <div>There are no tasks...</div>
        @endforelse

        @if ($tasks->count())
            <nav class="mt-4">{{ $tasks->links() }}</nav>
        @endif
    </div>


</x-app-layout>
