<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('My Applications') }}</h2>

        @if($offers->isEmpty())
            <p>{{ __('No applications found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($offers as $offer)
                    @php
                        $status = $offer->application->status;
                        switch ($status) {
                            case 'waiting':     $color = 'yellow'; break;
                            case 'accepted':    $color = 'green';   break;
                            case 'rejected':    $color = 'red';    break;
                            case 'ongoing':     $color = 'blue';   break;
                            case 'completed':   $color = 'blue';   break;
                        }
                    @endphp
                    <li class="border border-gray-300 p-4 rounded-md shadow-sm bg-{{$color}}-100">
                        <div class="grid grid-cols-6 gap-4">
                            <div>
                                <span class="font-bold">{{ __('Field: ') }}</span>
                                <span>{{ $offer->field }}</span>
                            </div>
                            <div>
                                <span class="font-bold">{{ __('Salary: ') }}</span>
                                <span>{{ $offer->salary }}</span>
                            </div>
                            <div>
                                <span class="font-bold">{{ __('Starts on: ') }}</span>
                                <span>{{ $offer->dateFrom }}</span>
                            </div>
                            <div>
                                <span class="font-bold">{{ __('End on: ') }}</span>
                                <span>{{ $offer->dateTo }}</span>
                            </div>
                            <div class="flex justify-center">
                                {{ $offer->application->status }}
                            </div>
                            <div class="flex justify-center">
                                <form class="inline" action="{{ route('cancel-application', $offer->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <x-primary-button>Cancel</x-primary-button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
                @if (session('message'))
                    <div class="text-red-500">{{ session('message') }}</div>
                @endif
            </ul>
        @endif 
    </div>
</x-app-layout>
