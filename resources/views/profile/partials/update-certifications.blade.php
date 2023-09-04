<div class="">
    <header>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Student Certifications') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update your certifications.") }}
                </p>
            </div>
        </div>

        <form action="{{route('student.upload')}}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <input type="hidden" id="studentId" name="studentId" value="{{$user->userable_id}}">
            <input type="file" name="certification"><br>
            <x-primary-button class="mt-2 mb-6">Upload</x-primary-button>
        </form>
        
        
        @foreach ($user->userable->certifications as $certification)
            <div class="flex justify-between items-center">
                <div class="my-2">{{$certification->name}}</div>
                <x-primary-button>Delete</x-primary-button>
            </div>
        @endforeach

    </header>
</div>