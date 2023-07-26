<x-guest-layout>
    <form method="POST" action="{{ route('register.student') }}">
        @csrf

        <x-user-fields/>

        {{-- GPA --}}
        <div class="mt-4">
            <x-input-label for="gpa" :value="__('GPA')" />
            <x-form-input type="text" name="gpa" value="{{ old('gpa') }}"/>
            <x-input-error :messages="$errors->get('gpa')" class="mt-2" />
        </div>

        {{-- University --}}
        <div class="mt-4">
            <x-input-label for="university" :value="__('University')" />
            <x-form-input type="text" name="university" value="{{ old('university') }}"/>
            <x-input-error :messages="$errors->get('university')" class="mt-2" />
        </div>
        
        {{-- Major --}}
        <div class="mt-4">
            <x-input-label for="major" :value="__('Major')" />
            <x-form-input type="text" name="major" value="{{ old('major') }}"/>
            <x-input-error :messages="$errors->get('major')" class="mt-2" />
        </div>
        
        {{-- Date enrolled --}}
        <div class="mt-4">
            <x-input-label for="dateEnrolled" :value="__('Date enrolled')" />
            <x-form-input type="date" name="dateEnrolled" value="{{ old('dateEnrolled') }}"/>
            <x-input-error :messages="$errors->get('dateEnrolled')" class="mt-2" />
        </div>
        
        {{-- Credits --}}
        <div class="mt-4">
            <x-input-label for="credits" :value="__('Credits')" />
            <x-form-input type="number" name="credits" value="{{ old('credits') }}"/>
            <x-input-error :messages="$errors->get('credits')" class="mt-2" />
        </div>

        {{-- <input type="hidden" name="userable_type" id="userable_type" value="student"> --}}

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
