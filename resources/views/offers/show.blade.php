<x-app-layout>
    <!-- Your view content here -->
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('Offer Details') }}</h2>

        <div class="border border-gray-300 p-4 rounded-md shadow-sm">
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
            <form action="{{ route('companies.show', $offer->company)}}"> @csrf @method('GET')
                <x-primary-button>View company</x-primary-button>
            </form>

            <form action="{{ route('apply', $offer->id)}}"> @csrf @method('GET')
                <x-primary-button>Apply for offer</x-primary-button>
            </form>
        @endcan

        @can('is-company')
            <form action="{{ route('applicants', $offer->id)}}"> @csrf @method('GET')
                <x-primary-button>View applicants</x-primary-button>
            </form>
        @endcan

        <br>        
        <a href="{{ back()->getTargetUrl() }}">
            <x-primary-button>Back</x-primary-button>
        </a>
    </div>
</x-app-layout>
