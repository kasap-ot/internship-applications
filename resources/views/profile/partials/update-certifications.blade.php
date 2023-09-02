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
            <input type="file" name="certification"><br>
            <input type="hidden" id="studentId" name="studentId" value="{{$user->userable_id}}">
            <x-primary-button class="mt-4">Upload</x-primary-button>
        </form>
        

        {{-- @foreach ( as )
            
        @endforeach --}}
    </header>
</div>