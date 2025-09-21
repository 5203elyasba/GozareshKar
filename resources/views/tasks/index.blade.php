<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tasks List') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Create New Task') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($tasks->isEmpty())
                        <p class="text-center">{{ __('No tasks have been assigned to you.') }}</p>
                    @else
                        <!-- Mobile View: Cards -->
                        <div class="grid grid-cols-1 gap-4 sm:hidden">
                            @foreach ($tasks as $task)
                                <div class="bg-gray-50 p-4 rounded-lg shadow space-y-3">
                                    <div class="font-bold text-lg">{{ $task->title }}</div>
                                    <div class="text-sm">
                                        <span class="font-semibold">{{ __('Status') }}:</span> {{ __($task->status) }}
                                    </div>
                                    <div class="text-sm">
                                        <span class="font-semibold">{{ __('Priority') }}:</span> {{ __($task->priority) }}
                                    </div>
                                    <div class="text-sm">
                                        <span class="font-semibold">{{ __('Due Date') }}:</span>
                                        {{ $task->due_date ? jdate($task->due_date)->format('Y/m/d') : __('N/A') }}
                                    </div>
                                    <div class="text-left">
                                         <a href="{{ route('tasks.show', $task) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">{{ __('View') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Desktop View: Table -->
                        <div class="hidden sm:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Priority') }}</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Due Date') }}</th>
                                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">View</span></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $task->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ __($task->status) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ __($task->priority) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $task->due_date ? jdate($task->due_date)->format('Y/m/d') : __('N/A') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('tasks.show', $task) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('View') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
