<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('offers.update', $offer) }}">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="field">Field</x-input-label>
                <x-form-input type="text" name="field" value="{{ old('field', $offer->field) }}" />
                <x-input-error :messages="$errors->get('field')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="salary">Salary</x-input-label>
                <x-form-input type="number" name="salary" value="{{ old('salary', $offer->salary) }}" />
                <x-input-error :messages="$errors->get('salary')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="dateFrom">Date from</x-input-label>
                <x-form-input type="date" name="dateFrom" value="{{ old('dateFrom', $offer->dateFrom) }}" />
                <x-input-error :messages="$errors->get('dateFrom')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="dateTo">Date to</x-input-label>
                <x-form-input type="date" name="dateTo" value="{{ old('dateTo', $offer->dateTo) }}" />
                <x-input-error :messages="$errors->get('dateTo')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description">Description</x-input-label>
                <x-form-input type="text" name="description" value="{{ old('description', $offer->description) }}" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="requirements">Requirements</x-input-label>
                <x-form-input type="text" name="requirements" value="{{ old('requirements', $offer->requirements) }}" />
                <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('offers.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
