<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('patch')

            <div>
                <label for="gpa" class="block font-medium text-gray-700">GPA</label>
                <input type="text" name="gpa" id="gpa" value="{{ old('gpa', $student->gpa) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('gpa')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="university" class="block font-medium text-gray-700">University Name</label>
                <input type="text" name="university" id="university" value="{{ old('university', $student->university) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('university')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="major" class="block font-medium text-gray-700">Major</label>
                <input type="text" name="major" id="major" value="{{ old('major', $student->major) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('major')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="enrollment_date" class="block font-medium text-gray-700">Date of Enrollment</label>
                <input type="date" name="enrollment_date" id="enrollment_date" value="{{ old('enrollment_date', $student->enrollment_date) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('enrollment_date')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="credits" class="block font-medium text-gray-700">Number of Credits</label>
                <input type="text" name="credits" id="credits" value="{{ old('credits', $student->credits) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <x-input-error :messages="$errors->get('credits')" class="mt-2" />
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('students.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
