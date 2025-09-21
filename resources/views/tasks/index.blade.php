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
                        <table class="w-full">
                            <thead class="hidden sm:table-header-group">
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Priority') }}</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Due Date') }}</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">View</span></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($tasks as $task)
                                    <tr class="block sm:table-row border-b sm:border-none mb-4 sm:mb-0">
                                        <td class="block sm:table-cell px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" data-label="{{ __('Title') }}">{{ $task->title }}</td>
                                        <td class="block sm:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="{{ __('Status') }}">{{ __($task->status) }}</td>
                                        <td class="block sm:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="{{ __('Priority') }}">{{ __($task->priority) }}</td>
                                        <td class="block sm:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="{{ __('Due Date') }}">{{ $task->due_date ? jdate($task->due_date)->format('Y/m/d') : __('N/A') }}</td>
                                        <td class="block sm:table-cell px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('tasks.show', $task) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('View') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        @media (max-width: 640px) {
            tbody, tr, td {
                display: block;
            }
            tr {
                border: 1px solid #e2e8f0;
                border-radius: 0.5rem;
                margin-bottom: 1rem;
            }
            td {
                position: relative;
                padding-left: 50%;
                text-align: right;
                border-bottom: 1px solid #e2e8f0;
            }
            td:last-child {
                border-bottom: none;
            }
            td:before {
                content: attr(data-label);
                position: absolute;
                left: 0.5rem;
                width: 45%;
                padding-right: 0.5rem;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
        }
    </style>
</x-app-layout>
