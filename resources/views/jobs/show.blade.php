<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $job->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <p class="text-gray-600">{{ $job->location }} • {{ $job->type }}</p>
                        <p class="mt-2">Salary: Rp {{ number_format($job->salary_min) }} - Rp {{ number_format($job->salary_max) }}</p>
                        <p class="mt-2">Posted by: {{ $job->employer->name }}</p>
                    </div>

                    <div class="prose max-w-none mb-6">
                        <h3 class="text-lg font-semibold mb-2">Job Description</h3>
                        {{ $job->description }}
                    </div>

                    @if(auth()->check() && auth()->user()->role === 'job_seeker')
                        <div class="mt-6">
                            <form action="{{ route('jobs.apply', $job) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <label for="cv" class="block text-sm font-medium text-gray-700">Upload your CV (PDF)</label>
                                    <input type="file" id="cv" name="cv" accept=".pdf" required
                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Apply Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>