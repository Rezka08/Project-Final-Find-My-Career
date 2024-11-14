<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Job Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('jobs.update', $job) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                                Job Title
                            </label>
                            <input type="text" name="title" id="title" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   value="{{ old('title', $job->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sama seperti form create, tapi dengan value dari $job -->
                        <!-- ... (field lainnya sama seperti create, tambahkan value="{{ old('field_name', $job->field_name) }}") ... -->

                        <div class="mb-4">
                            <label for="is_active" class="block text-gray-700 text-sm font-bold mb-2">
                                Status
                            </label>
                            <select name="is_active" id="is_active" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="1" {{ $job->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$job->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>