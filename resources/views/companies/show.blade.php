<x-app-layout>
    <!-- Your view content here -->
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('Company Details') }}</h2>

        <div class="border border-gray-300 p-4 rounded-md shadow-sm mb-4">
            {{-- Logo Image --}}
            <div class="mb-4">
                <img src="/storage/logoImages/{{$company->logoImage}}" alt="">
            </div>
            
            {{-- Name --}}
            <div class="mb-4">
                <span class="font-bold">{{ __('Name: ') }}</span>
                <span>{{ $company->user->name }}</span>
            </div>
            
            {{-- Email --}}
            <div class="mb-4">
                <span class="font-bold">{{ __('Email: ') }}</span>
                <span>{{ $company->user->email }}</span>
            </div>
            
            {{-- Num. employees --}}
            <div class="mb-4">
                <span class="font-bold">{{ __('Number of employees: ') }}</span>
                <span>{{ $company->numEmployees }}</span>
            </div>
            
            {{-- Field --}}
            <div class="mb-4">
                <span class="font-bold">{{ __('Field: ') }}</span>
                <span>{{ $company->field }}</span>
            </div>
            
            {{-- Founding year --}}
            <div class="mb-4">
                <span class="font-bold">{{ __('Founding year: ') }}</span>
                <span>{{ $company->foundingYear }}</span>
            </div>
            
            {{-- Description --}}
            <div class="mb-4">
                <span class="font-bold">{{ __('Description: ') }}</span>
                <span>{{ $company->description }}</span>
            </div>
            
            {{-- Website --}}
            <div class="mb-4">
                <span class="font-bold">{{ __('Website: ') }}</span>
                <span>{{ $company->website }}</span>
            </div>
            
            {{-- Address --}}
            <div class="mb-4">
                <span class="font-bold">{{ __('Address: ') }}</span>
                <span>{{ $company->address }}</span>
            </div>
        </div>

        <a href="{{ url()->previous() }}">
            <x-primary-button>Back</x-primary-button>
        </a>
    </div>
</x-app-layout>
