<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        @can('is-company')
            <h2 class="text-2xl font-bold mb-4">{{ __('My Offers') }}</h2>
        @endcan
        @can('is-student')
            <h2 class="text-2xl font-bold mb-4">{{ __('Offer List') }}</h2>
        @endcan

        @can('is-company')
            <div class="my-5">
                <form action="{{ route('offers.create') }}" method="GET"> @csrf @method('GET')
                    <x-primary-button>Create offer</x-primary-button>
                </form>
            </div>
        @endcan

        @if($offers->isEmpty())
            <p>{{ __('No offers found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($offers as $offer)
                    <li class="border border-gray-300 p-4 rounded-md shadow-sm bg-white">
                        <div class="grid grid-cols-5 gap-4">
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
                                <form class="inline" action="{{ route('offers.show', $offer) }}" method="GET">
                                    @csrf @method('GET')
                                    <x-primary-button>View offer</x-primary-button>
                                </form>
                            </div>
                        </div>

                        

                    </li>
                @endforeach
            </ul>
        @endif 
    </div>
</x-app-layout>
