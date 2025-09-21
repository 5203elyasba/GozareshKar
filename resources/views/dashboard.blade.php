<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Your Performance Summary') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Today's Work -->
                        <div class="bg-blue-50 p-6 rounded-lg text-center">
                            <dt class="text-sm font-medium text-blue-600 truncate">
                                {{ __('Today\'s Work') }}
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-blue-900">
                                {{ $stats['today'] }}
                            </dd>
                        </div>

                        <!-- This Week -->
                        <div class="bg-green-50 p-6 rounded-lg text-center">
                            <dt class="text-sm font-medium text-green-600 truncate">
                                {{ __('This Week') }}
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-green-900">
                                {{ $stats['week'] }}
                            </dd>
                        </div>

                        <!-- This Month -->
                        <div class="bg-yellow-50 p-6 rounded-lg text-center">
                            <dt class="text-sm font-medium text-yellow-600 truncate">
                                {{ __('This Month') }}
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-yellow-900">
                                {{ $stats['month'] }}
                            </dd>
                        </div>

                        <!-- Reports This Month -->
                        <div class="bg-indigo-50 p-6 rounded-lg text-center">
                            <dt class="text-sm font-medium text-indigo-600 truncate">
                                {{ __('Reports This Month') }}
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-indigo-900">
                                {{ $stats['reports_in_month'] }}
                            </dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
