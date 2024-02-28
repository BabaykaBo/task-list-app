<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Edit') }}
        </h2>
    </x-slot>

    <style>
        .error-message {
            color: red;
            font-size: 0.8rem;
            margin: 5px 0 5px 0;
        }
    </style>

    <div class="mt-5">
        <form action="{{ route('tasks.update', ['task' => $task]) }}" method="post">
            @csrf
            @method('PUT')
            <div class='mb-5'>
                <label class="block uppercase text-slate-700 text-bold mb-2" for="title">Title</label>
                <input class="shadow-sm border apparance-none w-full py-2 px-3 text-slate-700 leading-tight"
                    type="text" name="title" id="title" placeholder="Write title..."
                    value="{{ $task->title }}">
                @error('title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class='mb-5'>
                <label class="block uppercase text-slate-700 text-bold mb-2" for="description">Description</label>
                <textarea class="shadow-sm border apparance-none w-full py-2 px-3 text-slate-700 leading-tight" type="text"
                    name="description" id="description" cols="30" rows="10" placeholder="Write description...">{{ $task->description }}</textarea>
                @error('description')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>


            <div class='flex'>
                <div class='mr-6'>
                    <button class="rounded-md px-2 px-1 text-center ring-1 ring-blue-700 font-medium text-gray-700 "
                        type="submit">Edit</button>
                </div>
                <div>
                    <a class="rounded-md px-2 px-1 text-center ring-1 ring-green-700 font-medium text-gray-700 "
                        href="{{ route('tasks.index') }}">Back</a>
                </div>
            </div>


        </form>

    </div>


</x-app-layout>
