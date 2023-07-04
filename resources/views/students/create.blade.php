<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <div class="mb-4">
                <label for="gpa" class="block font-medium text-gray-700">GPA</label>
                <input type="text" name="gpa" id="gpa" class="mt-1 block w-full rounded-md border-gray-300">
            </div>

            <div class="mb-4">
                <label for="university" class="block font-medium text-gray-700">University Name</label>
                <input type="text" name="university" id="university" class="mt-1 block w-full rounded-md border-gray-300">
            </div>

            <div class="mb-4">
                <label for="major" class="block font-medium text-gray-700">Major</label>
                <input type="text" name="major" id="major" class="mt-1 block w-full rounded-md border-gray-300">
            </div>

            <div class="mb-4">
                <label for="dateEnrolled" class="block font-medium text-gray-700">Date of Enrollment</label>
                <input type="date" name="dateEnrolled" id="dateEnrolled" class="mt-1 block w-full rounded-md border-gray-300">
            </div>

            <div class="mb-4">
                <label for="credits" class="block font-medium text-gray-700">Credits</label>
                <input type="text" name="credits" id="credits" class="mt-1 block w-full rounded-md border-gray-300">
            </div>

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Add Student') }}</x-primary-button>
                <a href="{{ route('students.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
