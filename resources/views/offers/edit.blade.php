<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('offers.update', $offer) }}">
            @csrf
            @method('patch')

            <div>
                <label for="field" class="block font-medium text-gray-700">Field</label>
                <input type="text" name="field" id="field" value="{{ old('field', $offer->field) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('field')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="salary" class="block font-medium text-gray-700">Salary</label>
                <input type="number" name="salary" id="salary" value="{{ old('salary', $offer->salary) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('salary')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="dateFrom" class="block font-medium text-gray-700">Date from</label>
                <input type="date" name="dateFrom" id="dateFrom" value="{{ old('dateFrom', $offer->dateFrom) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('dateFrom')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="dateTo" class="block font-medium text-gray-700">Date to</label>
                <input type="date" name="dateTo" id="dateTo" value="{{ old('dateTo', $offer->dateTo) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('dateTo')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description', $offer->description) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="requirements" class="block font-medium text-gray-700">Requirements</label>
                <input type="text" name="requirements" id="requirements" value="{{ old('requirements', $offer->requirements) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('offers.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
