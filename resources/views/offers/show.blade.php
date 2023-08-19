<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('Offer Details') }}</h2>

        <div class="border border-gray-300 p-4 rounded-md shadow-sm bg-white">
            <div class="mb-4">
                <span class="font-bold">{{ __('Field: ') }}</span>
                <span>{{ $offer->field }}</span>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('Salary: ') }}</span>
                <span>{{ $offer->salary }}</span>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('Starts on: ') }}</span>
                <span>{{ $offer->dateFrom }}</span>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('End on: ') }}</span>
                <span>{{ $offer->dateTo }}</span>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('Description: ') }}</span>
                <p>{{ $offer->description }}</p>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('Requirements: ') }}</span>
                <p>{{ $offer->requirements }}</p>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('Company name: ') }}</span>
                <p>{{ $offer->company->user->name }}</p>
            </div>
        </div>
        <br>
        @can('is-student')
            <form class="inline mr-2" action="{{ route('companies.show', $offer->company->id)}}"> @csrf @method('GET')
                <x-primary-button>View company</x-primary-button>
            </form>
            @can('can-apply', $offer)
                <form class="inline" action="{{ route('apply', $offer->id)}}"> @csrf @method('GET')
                    <x-primary-button>Apply for offer</x-primary-button>
                </form>
            @endcan

            @if (session('message'))
                <span>{{ session('message') }}</span>
            @endif
        @endcan

        @can('offer-owner', $offer)   
                <form class="inline mr-1" action="{{ route('applicants', $offer->id)}}"> @csrf @method('GET')
                    <x-primary-button>Applicants</x-primary-button>
                </form>
                <form class="inline mx-1" action="{{ route('offers.edit', $offer) }}" method="GET"> 
                    @csrf @method('GET')
                    <x-primary-button>Edit</x-primary-button>
                </form>
                <form class="inline ml-1" action="{{ route('offers.destroy', $offer) }}" method="POST">
                    @csrf @method('DELETE')
                    <x-primary-button>Delete</x-primary-button>
                </form>
        @endcan

        <br>        
    </div>
</x-app-layout>
