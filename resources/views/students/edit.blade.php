<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="gpa">GPA</x-input-label>
                <x-form-input type="text" name="gpa" value="{{ old('gpa', $student->gpa) }}"/>
                <x-input-error :messages="$errors->get('gpa')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="university">University Name</x-input-label>
                <x-form-input type="text" name="university" value="{{ old('university', $student->university) }}"/>
                <x-input-error :messages="$errors->get('university')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="major">Major</x-input-label>
                <x-form-input type="text" name="major" value="{{ old('major', $student->major) }}"/>
                <x-input-error :messages="$errors->get('major')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="dateEnrolled">Date of Enrollment</x-input-label>
                <x-form-input type="date" name="dateEnrolled" value="{{ old('dateEnrolled', $student->dateEnrolled) }}"/>
                <x-input-error :messages="$errors->get('dateEnrolled')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="credits">Number of Credits</x-input-label>
                <x-form-input type="text" name="credits" value="{{ old('credits', $student->credits) }}"/>
                <x-input-error :messages="$errors->get('credits')" class="mt-2"/>
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('students.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
