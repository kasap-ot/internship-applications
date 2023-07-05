<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('Offer List') }}</h2>

        @if($offers->isEmpty())
            <p>{{ __('No offers found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($offers as $offer)
                    <li class="border border-gray-300 p-4 rounded-md shadow-sm">
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
                        <br> 
                        <div>
                            <a href="{{ route('offers.edit', $offer) }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Edit') }}
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="my-5">
            <a href="{{ route('offers.create') }}"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Create offer') }}
            </a>
        </div>
    </div>
</x-app-layout>
