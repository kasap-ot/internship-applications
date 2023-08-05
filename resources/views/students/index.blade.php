<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('Student List') }}</h2>

        @if($students->isEmpty())
            <p>{{ __('No students found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($students as $student)
                    <li class="border border-gray-300 p-4 rounded-md shadow-sm">
                        <div>
                            <span class="font-bold">{{ __('GPA: ') }}</span>
                            <span>{{ $student->gpa }}</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ __('University: ') }}</span>
                            <span>{{ $student->university }}</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ __('Major: ') }}</span>
                            <span>{{ $student->major }}</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ __('Date Enrolled: ') }}</span>
                            <span>{{ $student->dateEnrolled }}</span>
                        </div>
                        <div>
                            <span class="font-bold">{{ __('Credits: ') }}</span>
                            <span>{{ $student->credits }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="mt-6 p-4">
            {{ $students->links() }}
        </div>
    </div>
</x-app-layout>
