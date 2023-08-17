<x-guest-layout>
    <form method="POST" action="{{ route('register.admin') }}">
        @csrf

        <x-user-fields/>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
