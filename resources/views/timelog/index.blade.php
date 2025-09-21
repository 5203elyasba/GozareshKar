<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Time Clock') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="time-log-status" class="mb-4 text-sm text-gray-600 font-medium"></div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <button data-url="{{ route('timelog.clockIn') }}" class="time-log-btn inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Clock In') }}</button>
                        <button data-url="{{ route('timelog.startBreak') }}" class="time-log-btn inline-flex items-center justify-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Start Break') }}</button>
                        <button data-url="{{ route('timelog.endBreak') }}" class="time-log-btn inline-flex items-center justify-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 active:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('End Break') }}</button>
                        <button data-url="{{ route('timelog.clockOut') }}" class="time-log-btn inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">{{ __('Clock Out') }}</button>
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
                    const url = this.dataset.url;

                    statusDiv.textContent = 'Sending...';

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                           throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            statusDiv.textContent = `Success! Action logged at ${new Date().toLocaleTimeString()}`;
                        } else {
                            statusDiv.textContent = 'Error: ' + (data.message || 'Unknown error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        statusDiv.textContent = 'Request failed. Please check the console for details.';
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
