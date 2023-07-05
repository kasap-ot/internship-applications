<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('companies.store') }}">
            @csrf
            <div class="mb-4">
                <x-input-label for="numEmployees">Number of employees</x-input-label>
                <x-form-input type="number" name="numEmployees" value="{{ old('numEmployees') }}"/>
                <x-input-error :messages="$errors->get('numEmployees')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="field">Field</x-input-label>
                <x-form-input type="text" name="field" value="{{ old('field') }}"/>
                <x-input-error :messages="$errors->get('field')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="foundingYear">Founding year</x-input-label>
                <x-form-input type="text" name="foundingYear" value="{{ old('foundingYear') }}"/>
                <x-input-error :messages="$errors->get('foundingYear')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="description">Description</x-input-label>
                <x-form-input type="text" name="description" value="{{ old('description') }}"/>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="website">Website</x-input-label>
                <x-form-input type="text" name="website" value="{{ old('website') }}"/>
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="address">Address</x-input-label>
                <x-form-input type="text" name="address" value="{{ old('address') }}"/>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Add Company') }}</x-primary-button>
                <a href="{{ route('companies.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
