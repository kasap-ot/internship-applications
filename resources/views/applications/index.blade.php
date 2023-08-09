<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('My Applications') }}</h2>

        @if($offers->isEmpty())
            <p>{{ __('No applications found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($offers as $offer)
                    <li class="border border-gray-300 p-4 rounded-md shadow-sm">
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
                                <x-primary-button>Cancel</x-primary-button>
                            </div>
                        </div>

                        {{-- <div class="mt-4">
                            @can('offer-owner', $offer)                           
                                <form class="inline" action="{{ route('offers.edit', $offer) }}" method="GET"> 
                                    @csrf @method('GET')
                                    <x-primary-button>Edit</x-primary-button>
                                </form>

                                <form class="inline" action="{{ route('offers.destroy', $offer) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <x-primary-button>Delete</x-primary-button>
                                </form>

                                <form class="inline" action="{{ route('applicants', $offer->id) }}" method="POST">
                                    @csrf @method('GET')
                                    <x-primary-button>View applicants</x-primary-button>
                                </form>                                
                            @endcan
                            
                            <form class="inline" action="{{ route('offers.show', $offer) }}" method="GET">
                                @csrf @method('GET')
                                <x-primary-button>View offer</x-primary-button>
                            </form>
                        </div> --}}
                    </li>
                @endforeach
            </ul>
        @endif 
        {{-- <div class="mt-6 p-4">
            {{ $offers->links() }}
        </div>    --}}
    </div>
</x-app-layout>
