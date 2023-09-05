<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            
            @can('is-admin')
                <div class=" my-4 flex justify-between space-x-6">
                    <a href="{{route('user-requests')}}" class="w-1/3">
                        <x-secondary-button class="flex justify-center w-full h-60">
                            User requests
                        </x-primary-button>
                    </a>
                    <a href="{{route('verified-users')}}" class="w-1/3">
                        <x-secondary-button class="flex justify-center w-full h-60">
                            Verified users
                        </x-primary-button>                    
                    </a>
                    <a href="{{route('profile.edit')}}" class="w-1/3">
                        <x-secondary-button class="flex justify-center w-full h-60">
                            My profile
                        </x-primary-button>
                    </a>
                </div>
            @endcan
            
            @can('is-company')
                <div class=" my-4 flex justify-between space-x-6">
                    <a href="{{route('offers.index')}}" class="w-1/2">
                        <x-secondary-button class="flex justify-center w-full h-60">
                            My offers
                        </x-primary-button>                    
                    </a>
                    <a href="{{route('profile.edit')}}" class="w-1/2">
                        <x-secondary-button class="flex justify-center w-full h-60">
                            My profile
                        </x-primary-button>
                    </a>
                </div>
            @endcan

            @can('is-student')
            <div class=" my-4 flex justify-between space-x-6">
                <a href="{{route('offers.index')}}" class="w-1/3">
                    <x-secondary-button class="flex justify-center w-full h-60">
                        Offers
                    </x-primary-button>
                </a>
                <a href="{{route('applications')}}" class="w-1/3">
                    <x-secondary-button class="flex justify-center w-full h-60">
                        My applications
                    </x-primary-button>                    
                </a>
                <a href="{{route('profile.edit')}}" class="w-1/3">
                    <x-secondary-button class="flex justify-center w-full h-60">
                        My profile
                    </x-primary-button>
                </a>
            </div>
            @endcan

        </div>
    </div>
</x-app-layout>
