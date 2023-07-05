<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('companies.update', $company) }}">
            @csrf
            @method('patch')

            <div>
                <label for="numEmployees" class="block font-medium text-gray-700">Number of employees</label>
                <input type="number" name="numEmployees" id="numEmployees" value="{{ old('numEmployees', $company->numEmployees) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('numEmployees')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="field" class="block font-medium text-gray-700">Field</label>
                <input type="text" name="field" id="field" value="{{ old('field', $company->field) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('field')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="foundingYear" class="block font-medium text-gray-700">Founding year</label>
                <input type="text" name="foundingYear" id="foundingYear" value="{{ old('foundingYear', $company->foundingYear) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('foundingYear')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description', $company->description) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="website" class="block font-medium text-gray-700">Website</label>
                <input type="text" name="website" id="website" value="{{ old('website', $company->website) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="address" class="block font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $company->address) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('companies.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
