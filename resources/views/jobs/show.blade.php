// resources/views/jobs/show.blade.php
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">{{ $job->title }}</h2>
                    <div class="mb-4">
                        <p class="text-gray-600">{{ $job->location }} • {{ $job->type }}</p>
                        <p class="text-gray-600">Salary: ${{ number_format($job->salary_min) }} - 
                            ${{ number_format($job->salary_max) }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Description</h3>
                        <p class="whitespace-pre-line">{{ $job->description }}</p>
                    </div>
                    
                    @auth
                        @if(auth()->user()->isJobSeeker())
                            <form action="{{ route('jobs.apply', $job) }}" method="POST" 
                                  enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" 
                                           for="cv">Upload CV (PDF)</label>
                                    <input type="file" name="cv" id="cv" accept=".pdf" required
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                                </div>
                                <button type="submit" 
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                    Apply Now
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>