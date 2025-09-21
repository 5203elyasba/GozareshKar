<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-4">

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Title') }}</h3>
                        <p class="text-gray-900">{{ $task->title }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Description') }}</h3>
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $task->description ?? 'No description.' }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Priority') }}</h3>
                        <p class="text-gray-900 capitalize">{{ $task->priority }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Due Date') }}</h3>
                        <p class="text-gray-900">{{ $task->due_date ? jdate($task->due_date)->format('Y/m/d') : 'Not set' }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Assigned To') }}</h3>
                        <p class="text-gray-900">{{ $task->assignee->name ?? 'Not assigned' }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Created By') }}</h3>
                        <p class="text-gray-900">{{ $task->creator->name }}</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Edit Task') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
