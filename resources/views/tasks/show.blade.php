<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($task->title) }}
        </h2>
    </x-slot>

    <div>

        <h3 class="font-semibold text-lg mb-5 mt-5">Description</h3>
        <p class="mb-5">{{ $task->description }}</p>


        <div class="mb-5">
            @if ($task->completed)
                <span class="text-green-500">Completed</span>
            @else
                <span class="text-red-500">Uncompleted</span>
            @endif
        </div>

        <p>Created at: {{ $task->created_at->diffForHumans() }}</p>
        <p>Updated at: {{ $task->updated_at->diffForHumans() }}</p>

        <div class="flex mt-5">
            <div class="mr-10">
                <form action="{{ route('tasks.complete', ['task' => $task]) }}" method="post">
                    @csrf
                    @method('PUT')

                    @if ($task->completed)
                        <button class="rounded-md px-2 px-1 text-center ring-1 ring-red-700 font-medium text-gray-700 "
                            type="submit">Mark as
                            uncompleted</button>
                    @else
                        <button
                            class="rounded-md px-2 px-1 text-center ring-1 ring-green-700 font-medium text-gray-700 "
                            type="submit">Mark as
                            completed</button>
                    @endif

                </form>
            </div>
            <div class="mr-10">
                <a class="rounded-md px-2 px-1 text-center ring-1 ring-blue-700 font-medium text-gray-700 "
                    href="{{ route('tasks.edit', ['task' => $task]) }}">Edit</a>
            </div>
            <div>
                <a class="rounded-md px-2 px-1 text-center ring-1 ring-yellow-700 font-medium text-gray-700 "
                    href="{{ route('tasks.index') }}">Back</a>
            </div>


        </div>

    </div>


    </div>


</x-app-layout>
