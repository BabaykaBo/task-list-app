<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Create') }}
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
        <form action="{{ route('tasks.store') }}" method="post">
            @csrf
            <div class='mb-5'>
                <label class="block uppercase text-slate-700 text-bold mb-2" for="title">Title</label>
                <input class="shadow-sm border apparance-none w-full py-2 px-3 text-slate-700 leading-tight"
                    type="text" type="text" name="title" id="title" placeholder="Write title..."
                    value="{{ old('title') }}">
                @error('title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class='mb-5'>
                <label class="block uppercase text-slate-700 text-bold mb-2" for="description">Description</label>
                <textarea class="shadow-sm border apparance-none w-full py-2 px-3 text-slate-700 leading-tight" type="text"
                    name="description" id="description" cols="30" rows="10" placeholder="Write description...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class='flex'>
                <div class='mr-5'>
                    <button class="rounded-md px-2 px-1 text-center ring-1 ring-pink-700 font-medium text-gray-700 "
                        type="submit">Save</button>
                </div>
                <div>
                    <a class="rounded-md px-2 px-1 text-center ring-1 ring-blue-700 font-medium text-gray-700 "
                        href="{{ route('tasks.index') }}">Back</a>
                </div>
            </div>

        </form>

    </div>


</x-app-layout>
