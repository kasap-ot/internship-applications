<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="text-2xl font-bold flex justify-center mb-4 mt-4">
            Add your work experience
        </div>
        
        <form action="{{route('experience.store')}}" method="POST">
            @csrf
        
                <div class="col-span-1">
                    <label for="position" class="block font-bold">Position:</label>
                    <input type="text" name="position" id="position" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                </div>
        
                <div class="col-span-1">
                    <label for="startDate" class="block font-bold">Start Date:</label>
                    <input type="date" name="startDate" id="startDate" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                </div>
        
                <div class="col-span-1">
                    <label for="endDate" class="block font-bold">End Date:</label>
                    <input type="date" name="endDate" id="endDate" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                </div>
        
            <div class="mt-4">
                <label for="description" class="block font-bold">Description:</label>
                <textarea name="description" id="description" class="w-full border border-gray-300 rounded-md px-3 py-2" rows="4" required></textarea>
            </div>
        
            {{-- <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Save</button>
            </div> --}}

            <x-primary-button class="mt-4">Save</x-primary-button>
        </form>
    </div>    
</x-app-layout>