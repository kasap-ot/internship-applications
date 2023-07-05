<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('companies.update', $company) }}">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="numEmployees">Number of employees</x-input-label>
                <x-form-input type="number" name="numEmployees" value="{{ old('numEmployees', $company->numEmployees) }}"/>
                <x-input-error :messages="$errors->get('numEmployees')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="field">Field</x-input-label>
                <x-form-input type="text" name="field" value="{{ old('field', $company->field) }}"/>
                <x-input-error :messages="$errors->get('field')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="foundingYear">Founding year</x-input-label>
                <x-form-input type="text" name="foundingYear" value="{{ old('foundingYear', $company->foundingYear) }}"/>
                <x-input-error :messages="$errors->get('foundingYear')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description">Description</x-input-label>
                <x-form-input type="text" name="description" value="{{ old('description', $company->description) }}"/>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="website">Website</x-input-label>
                <x-form-input type="text" name="website" value="{{ old('website', $company->website) }}"/>
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="address">Address</x-input-label>
                <x-form-input type="text" name="address" value="{{ old('address', $company->address) }}"/>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('companies.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
