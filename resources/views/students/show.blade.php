<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="grid grid-cols-2">
            <div class="text-2xl font-bold mb-4">{{ __('Student Profile') }}</div>
            <div class="flex justify-end">
                <a href="{{ url()->previous() }}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>

        @php
            $headingStyles = "mt-4 border border-gray-300 p-4 rounded-md shadow-sm flex justify-center text-lg font-bold bg-slate-200";
            $segmentStyles = "border border-gray-300 p-4 rounded-md shadow-sm bg-white";
        @endphp

        <div class="{{$headingStyles}}">
            Academic Profile
        </div>

        <div class="{{$segmentStyles}}">            
            <div class="mb-4">
                <span class="font-bold">{{ __('GPA: ') }}</span>
                <span>{{ $student->gpa }}</span>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('University: ') }}</span>
                <span>{{ $student->university }}</span>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('Major: ') }}</span>
                <span>{{ $student->major }}</span>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('Date enrolled: ') }}</span>
                <span>{{ $student->dateEnrolled }}</span>
            </div>
            <div class="mb-4">
                <span class="font-bold">{{ __('Credits: ') }}</span>
                <span>{{ $student->credits }}</span>
            </div>
        </div>

        <div class="{{$headingStyles}}">
            Work experience
        </div>
        <div class="{{$segmentStyles}}">
            Work experience items <br>
            Work experience items <br>
            Work experience items <br>
            Work experience items <br>
            Work experience items <br>
            Work experience items <br>
        </div>

        <div class="{{$headingStyles}}">
            Skills
        </div>
        <div class="{{$segmentStyles}}">
            Skill items <br>
            Skill items <br>
            Skill items <br>
            Skill items <br>
            Skill items <br>
            Skill items <br>
        </div>

        <div class="{{$headingStyles}}">
            Languages
        </div>
        <div class="{{$segmentStyles}}">
            Language items <br>
            Language items <br>
            Language items <br>
            Language items <br>
            Language items <br>
            Language items <br>
        </div>

        <div class="{{$headingStyles}}">
            Hobbies
        </div>
        <div class="{{$segmentStyles}}">
            Hobby items <br>
            Hobby items <br>
            Hobby items <br>
            Hobby items <br>
            Hobby items <br>
            Hobby items <br>
            Hobby items <br>
            Hobby items <br>
        </div>
    </div>
</x-app-layout>
