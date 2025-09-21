<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Details for') }} {{ jdate($report->report_date)->format('Y/m/d') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-4">

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Report Date') }}</h3>
                        <p class="text-gray-900">{{ jdate($report->report_date)->format('%A, %d %B %Y') }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Start Time') }}</h3>
                        <p class="text-gray-900">{{ $report->start_time }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('End Time') }}</h3>
                        <p class="text-gray-900">{{ $report->end_time ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700">{{ __('Description of Tasks') }}</h3>
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $report->variable_tasks ?? 'No description provided.' }}</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('daily-reports.edit', $report) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
