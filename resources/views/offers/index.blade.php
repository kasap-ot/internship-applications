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

                        <form class="mt-4" action="{{ route('offers.edit', $offer) }}" method="GET">
                            @csrf
                            @method('GET')
                        
                            <x-primary-button class="mb-1" type="submit">Edit</x-danger-button>
                        </form>

                        <form action="{{ route('offers.destroy', $offer) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        
                            <x-danger-button type="submit">Delete</x-danger-button>
                        </form>
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
        <div class="mt-6 p-4">
            {{ $offers->links() }}
        </div>
        
        {{-- <form action="/applications/apply?studentId=7&offerId=2" method="POST">
            @csrf
            <x-danger-button type="submit">APPLY</x-danger-button>
        </form>

        <form action="/applications/accept?studentId=7&offerId=2" method="POST">
            @csrf
            @method('PUT')
            <x-danger-button type="submit">ACCEPT</x-danger-button>
        </form>

        <form action="/applications/update?studentId=8&offerId=2" method="POST">
            @csrf
            @method('PUT')
            <x-danger-button type="submit">UPDATE</x-danger-button>
        </form> --}}

        <form action="/applications/cancel?studentId=8&offerId=2" method="POST">
            @csrf
            @method('DELETE')
            <x-danger-button type="submit">CANCEL</x-danger-button>
        </form>
    
    </div>
</x-app-layout>
