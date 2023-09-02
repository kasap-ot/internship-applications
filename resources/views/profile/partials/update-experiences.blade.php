<div class="">
    <header>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Student Experiences') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update your account's student experiences.") }}
                </p>
            </div>
            <div class="flex justify-end items-center">
                <a href="{{route('experience.create')}}">
                    <x-primary-button>Add</x-primary-button>
                </a>
            </div>
        </div>


        @foreach ($user->userable->experiences as $experience)
            <div class="my-6">
                <div class="mb-2 font-bold">
                    <span>{{$experience->position}}</span>
                    <span>({{$experience->fromDate}}, {{$experience->toDate}})</span>
                </div>
                <div>{{$experience->description}}</div>
            </div>

            <form action="{{route('experience.destroy', $experience->id)}}" method="POST">
            @csrf @method('DELETE')
                <x-primary-button>Delete item</x-primary-button>
            </form>
        @endforeach
    </header>
</div>