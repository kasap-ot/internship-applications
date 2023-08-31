<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Student Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's student information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- GPA --}}
        <div>
            <x-input-label for="gpa" :value="__('GPA')" />
            <x-text-input id="gpa" name="gpa" type="text" class="mt-1 block w-full" :value="old('gpa', $user->userable->gpa)" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('gpa')" />
        </div>
        
        {{-- University --}}
        <div>
            <x-input-label for="university" :value="__('University')" />
            <x-text-input id="university" name="university" type="text" class="mt-1 block w-full" :value="old('university', $user->userable->university)" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('university')" />
        </div>
        
        {{-- Major --}}
        <div>
            <x-input-label for="major" :value="__('Major')" />
            <x-text-input id="major" name="major" type="text" class="mt-1 block w-full" :value="old('major', $user->userable->major)" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('major')" />
        </div>
        
        {{-- Date enrolled --}}
        <div>
            <x-input-label for="dateEnrolled" :value="__('Date enrolled')" />
            <x-text-input id="dateEnrolled" name="dateEnrolled" type="date" class="mt-1 block w-full" :value="old('dateEnrolled', $user->userable->dateEnrolled)" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('dateEnrolled')" />
        </div>
        
        {{-- Date Credits --}}
        <div>
            <x-input-label for="credits" :value="__('Credits')" />
            <x-text-input id="credits" name="credits" type="number" class="mt-1 block w-full" :value="old('credits', $user->userable->credits)" required autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('credits')" />
        </div>
        
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <div class="mt-8">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Student Experiences') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's student experiences.") }}
            </p>

            <br>
            <a href="{{route('experience.create')}}">
                <x-primary-button>Add</x-primary-button>
            </a>

            @foreach ($user->userable->experiences as $experience)
                <div class="my-6">
                    <div class="mb-2 font-bold">
                        <span>{{$experience->position}}</span>
                        <span>({{$experience->fromDate}}, {{$experience->toDate}})</span>
                    </div>
                    <div>{{$experience->description}}</div>
                </div>

                <form action="{{route('experience.destroy')}}"></form>
            @endforeach
        </header>
    </div>
</section>
