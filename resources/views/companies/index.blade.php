<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('Company List') }}</h2>

        @if($companies->isEmpty())
            <p>{{ __('No companies found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($companies as $company)
                    <li class="border border-gray-300 p-4 rounded-md shadow-sm">
                        <div>
                            <span class="font-bold">{{ __('Number of employees: ') }}</span>
                            <span>{{ $company->numEmployees }}</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ __('Field: ') }}</span>
                            <span>{{ $company->field }}</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ __('Founded in: ') }}</span>
                            <span>{{ $company->foundingYear }}</span>
                        </div>
                        
                        {{-- NOTE: do we need to have the description here? --}}

                        <div>
                            <span class="font-bold">{{ __('Website: ') }}</span>
                            <span>{{ $company->website }}</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ __('Address: ') }}</span>
                            <span>{{ $company->address }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
