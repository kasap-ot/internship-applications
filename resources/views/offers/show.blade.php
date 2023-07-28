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
        <x-button-link color="green" href="{{ route('companies.show', $offer->company) }}">
            View company
        </x-button-link>
        <br><br>
        <x-button-link color="green" href="{{ route('apply', $offer->id) }}">
            Apply for offer
        </x-button-link>

        <!-- Add any additional content or actions here -->
    </div>
</x-app-layout>
