<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('Verified Users') }}</h2>

        @if($verifiedUsers->isEmpty())
            <p>{{ __('No verified users found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($verifiedUsers as $user)
                    @php
                        $userType = $user->userable_type;
                        switch ($userType) {
                            case 'App\Models\Student': 
                                $styles = 'border border-gray-300 p-4 rounded-md shadow-sm bg-yellow-200'; 
                                $displayType = 'Student'; 
                            break;
                            case 'App\Models\Company': 
                                $styles = 'border border-gray-300 p-4 rounded-md shadow-sm bg-orange-200'; 
                                $displayType = 'Company'; 
                            break;
                            case 'admin':              
                                $styles = 'border border-gray-300 p-4 rounded-md shadow-sm bg-green-200'; 
                                $displayType = 'Admin'; 
                            break;
                        }
                    @endphp
                    <li class="{{$styles}}">
                        <div class="grid grid-cols-4 gap-4">
                            {{-- user name --}}
                            <div>{{ $user->name }}</div>
                            
                            {{-- email --}}
                            <div>{{ $user->email }}</div>
                            
                            {{-- user type --}}
                            <div class="flex justify-center">{{ $displayType }}</div>
                            
                            {{-- view profile --}}
                            <div class="flex justify-center">
                                <a href="{{route('profile.show', $user->id)}}">
                                    <x-primary-button>View profile</x-primary-button>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif 
    </div>
</x-app-layout>
