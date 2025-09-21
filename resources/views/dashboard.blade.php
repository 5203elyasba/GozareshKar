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
                    <p>{{ __("You're logged in!") }}</p>

                    <div class="mt-4">
                        <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Go to Tasks') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">{{ __('Time Clock') }}</h3>
                    <div id="time-log-status" class="mt-2 text-sm text-gray-600"></div>
                    <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <button data-action="clockIn" class="time-log-btn inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Clock In') }}</button>
                        <button data-action="startBreak" class="time-log-btn inline-flex items-center justify-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Start Break') }}</button>
                        <button data-action="endBreak" class="time-log-btn inline-flex items-center justify-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('End Break') }}</button>
                        <button data-action="clockOut" class="time-log-btn inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Clock Out') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const timeLogButtons = document.querySelectorAll('.time-log-btn');
            const statusDiv = document.getElementById('time-log-status');

            timeLogButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const action = this.dataset.action;
                    const routeName = `timelog.${action}`;

                    // We need to find the correct route URL from the named routes if possible,
                    // but for this simple case, we can construct it.
                    const url = `/time-log/${action.replace(/([A-Z])/g, "-$1").toLowerCase()}`;

                    statusDiv.textContent = 'Sending...';

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            statusDiv.textContent = `Successfully logged: ${action} at ${new Date().toLocaleTimeString()}`;
                        } else {
                            statusDiv.textContent = 'Error: ' + (data.message || 'Unknown error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        statusDiv.textContent = 'Request failed. See console for details.';
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
