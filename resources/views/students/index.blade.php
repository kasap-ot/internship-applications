<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">{{ __('Student List') }}</h2>

        @if($students->isEmpty())
            <p>{{ __('No students found.') }}</p>
        @else
            <ul class="space-y-4">
                @foreach($students as $student)
                    @php
                        $offerId = request()->route('offerId');
                        $status = DB::table('offer_student')
                            ->where('offer_id', $offerId)
                            ->where('student_id', $student->id)
                            ->value('status');
                        switch ($status) {
                            case 'waiting':     $color = 'yellow'; break;
                            case 'accepted':    $color = 'green'; break;
                            case 'rejected':    $color = 'red'; break;
                            case 'ongoing':     $color = 'blue'; break;
                            case 'completed':   $color = 'blue'; break;
                            default:            $color = 'gray'; break;
                        }
                    @endphp

                    <li class="border border-gray-300 p-4 rounded-md shadow-sm bg-{{$color}}-100">

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <div>
                                    <span class="font-bold">{{ __('Student: ') }}</span>
                                    <span>{{ $student->user->name }}</span>
                                </div>
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
                            </div>

                            <div class="flex justify-center">{{ $status }}</div>
                            
                            <div class="flex justify-end">
                                @if ($status == 'waiting')                                    
                                <form action="{{ route('accept', ['offerId' => $offerId, 'studentId' => $student->id]) }}" method="POST">
                                    @csrf @method('PUT')
                                    <x-primary-button>Accept applicant</x-primary-button>
                                </form>
                                @endif
                            </div>
                        </div>
                        
                        @if (session('message') && session('studentId') == $student->id)
                            <div class="flex justify-end">{{ session('message') }}</div>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif

        <br>
        <a href="{{ url()->previous() }}">
            <x-primary-button>Back</x-primary-button>
        </a>  
    </div>
</x-app-layout>
