<x-app-layout>
    <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('User Registration Requests') }}</h2>

        @if($unverifiedUsers->isEmpty())
            <p>{{ __('No registration requests found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($unverifiedUsers as $user)
                    <li class="border border-gray-300 p-4 rounded-md shadow-sm bg-slate-100">
                        <div class="grid grid-cols-5 gap-4">
                            {{-- user name --}}
                            <div>{{ $user->name }}</div>
                            
                            {{-- email --}}
                            <div>{{ $user->email }}</div>
                            
                            {{-- user type --}}
                            <div>{{ $user->userable_type }}</div>
                            
                            {{-- view profile --}}
                            <div>
                                <a href="{{route('profile.show', $user->id)}}">
                                    <x-primary-button>View profile</x-primary-button>
                                </a>
                            </div>

                            {{-- aprove / reject --}}
                            <div>
                                <form class="inline" action="{{route('verify-user', ['userId' => $user->id])}}" method="POST"> 
                                    @csrf @method('PUT')
                                    <x-primary-button>Approve</x-primary-button>
                                </form>
                                <form class="inline" action="{{route('reject-user', ['userId' => $user->id])}}" method="POST"> 
                                    @csrf @method('PUT')
                                    <x-primary-button>Reject</x-primary-button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif 
    </div>
</x-app-layout>
