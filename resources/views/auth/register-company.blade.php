<x-guest-layout>
    <form method="POST" action="{{ route('register.company') }}">
        @csrf

        <x-user-fields/>

        {{-- number of employees --}}
        <div class="mt-4">
            <x-input-label for="numEmployees">Number of employees</x-input-label>
            <x-form-input type="number" name="numEmployees" value="{{ old('numEmployees') }}"/>
            <x-input-error :messages="$errors->get('numEmployees')" class="mt-2" />
        </div>

        {{-- field --}}
        <div class="mt-4">
            <x-input-label for="field">Field</x-input-label>
            <x-form-input type="text" name="field" value="{{ old('field') }}"/>
            <x-input-error :messages="$errors->get('field')" class="mt-2" />
        </div>

        {{-- founding year --}}
        <div class="mt-4">
            <x-input-label for="foundingYear">Founding year</x-input-label>
            <x-form-input type="text" name="foundingYear" value="{{ old('foundingYear') }}"/>
            <x-input-error :messages="$errors->get('foundingYear')" class="mt-2" />
        </div>

        {{-- description --}}
        <div class="mt-4">
            <x-input-label for="description">Description</x-input-label>
            <x-form-textarea name="description" value="{{ old('description') }}"/>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        {{-- website --}}
        <div class="mt-4">
            <x-input-label for="website">Website</x-input-label>
            <x-form-input type="text" name="website" value="{{ old('website') }}"/>
            <x-input-error :messages="$errors->get('website')" class="mt-2" />
        </div>

        {{-- address --}}
        <div class="mt-4">
            <x-input-label for="address">Address</x-input-label>
            <x-form-input type="text" name="address" value="{{ old('address') }}"/>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
