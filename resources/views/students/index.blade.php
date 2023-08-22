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
                            case 'waiting':   $liElementStyle = "border border-gray-300 p-4 rounded-md shadow-sm bg-yellow-100"; break;
                            case 'accepted':  $liElementStyle = "border border-gray-300 p-4 rounded-md shadow-sm bg-green-100"; break;
                            case 'rejected':  $liElementStyle = "border border-gray-300 p-4 rounded-md shadow-sm bg-red-100"; break;
                            case 'ongoing':   $liElementStyle = "border border-gray-300 p-4 rounded-md shadow-sm bg-blue-100"; break;
                            case 'completed': $liElementStyle = "border border-gray-300 p-4 rounded-md shadow-sm bg-blue-100"; break;
                            default:          $liElementStyle = "border border-gray-300 p-4 rounded-md shadow-sm bg-gray-100"; break;
                        }
                    @endphp

                    <li class="{{$liElementStyle}}">

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <div>
                                    <span class="font-bold">{{ __('Student: ') }}</span>
                                    <span>{{ $student->user->name }}</span>
                                </div>

                                <a href="{{route('student.show', $student)}}">
                                    <x-primary-button class="mt-2">View Profile</x-primary-button>
                                </a>
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
        <a href="{{ route('offers.show', $offerId) }}">
            <x-primary-button>Back</x-primary-button>
        </a>  
    </div>
</x-app-layout>
