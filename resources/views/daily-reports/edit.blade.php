<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('daily-reports.update', $report) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Report Date -->
                        <div>
                            <x-input-label for="report_date" :value="__('Report Date')" />
                            <x-text-input id="report_date" class="block mt-1 w-full bg-gray-100" type="text" name="report_date" :value="jdate($report->report_date)->format('Y/m/d')" readonly />
                        </div>

                        <!-- Start Time -->
                        <div class="mt-4">
                            <x-input-label for="start_time" :value="__('Start Time')" />
                            <x-text-input id="start_time" class="block mt-1 w-full" type="text" name="start_time" :value="old('start_time', $report->start_time)" placeholder="HH:MM" required pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" title="Please enter time in 24-hour format (e.g., 14:30)." />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>

                        <!-- End Time -->
                        <div class="mt-4">
                            <x-input-label for="end_time" :value="__('End Time')" />
                            <x-text-input id="end_time" class="block mt-1 w-full" type="text" name="end_time" :value="old('end_time', $report->end_time)" placeholder="HH:MM" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" title="Please enter time in 24-hour format (e.g., 14:30)." />
                            <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                        </div>

                        <!-- Variable Tasks -->
                        <div class="mt-4">
                            <x-input-label for="variable_tasks" :value="__('Description of Other Tasks')" />
                            <textarea id="variable_tasks" name="variable_tasks" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('variable_tasks', $report->variable_tasks) }}</textarea>
                            <x-input-error :messages="$errors->get('variable_tasks')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update Report') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
