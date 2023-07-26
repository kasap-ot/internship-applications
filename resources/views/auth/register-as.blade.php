<x-guest-layout>
    <div class="max-w-md mx-auto mt-4 p-4">
        <div class="text-center">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Register as') }}</h2>
            <div class="space-y-4">
                <a href="{{ route('register.student') }}">
                    <x-secondary-button type="button">{{ __('Student') }}</x-secondary-button>
                </a>
                <a href="{{ route('register.company') }}">
                    <x-secondary-button type="button">{{ __('Company') }}</x-secondary-button>
                </a>
                <a href="{{ route('register.admin') }}">
                    <x-secondary-button type="button">{{ __('Admin') }}</x-secondary-button>
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
