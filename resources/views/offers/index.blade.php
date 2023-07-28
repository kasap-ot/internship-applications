<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        @can('is-company')
            <h2 class="text-2xl font-bold mb-4">{{ __('My Offers') }}</h2>
        @endcan
        @can('is-student')
            <h2 class="text-2xl font-bold mb-4">{{ __('Offer List') }}</h2>
        @endcan

        @can('is-company')
            <div class="my-5">
                <x-button-link color="green" href="{{ route('offers.create') }}">
                    Create offer
                </x-button-link>
            </div>
        @endcan

        @if($offers->isEmpty())
            <p>{{ __('No offers found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($offers as $offer)
                    <li class="border border-gray-300 p-4 rounded-md shadow-sm">
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
                            <div>
                                <x-button-link color="green" href="{{ route('offers.show', $offer) }}">
                                    View offer
                                </x-button-link>
                            </div>
                        </div>

                        @can('offer-owner', $offer)                           
                            <div class="mt-4">
                                <form class="inline" action="{{ route('offers.edit', $offer) }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <x-primary-button type="submit">Edit</x-primary-button>
                                </form>

                                <form class="inline" action="{{ route('offers.destroy', $offer) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button type="submit">Delete</x-primary-button>
                                </form>

                                <form class="inline" action="{{ route('applicants', ['offerId' => $offer->id]) }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <x-primary-button type="submit">View applicants</x-primary-button>
                                </form>
                            </div>
                        @endcan
                    </li>
                @endforeach
            </ul>
        @endif 
        <div class="mt-6 p-4">
            {{ $offers->links() }}
        </div>   
    </div>
</x-app-layout>
