<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Available Jobs</h2>
                    
                    <div class="mb-4">
                        <form action="{{ route('jobs.public') }}" method="GET">
                            <input type="text" name="search" placeholder="Search jobs..." 
                                   class="rounded-md border-gray-300" value="{{ request('search') }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                Search
                            </button>
                        </form>
                    </div>

                    @foreach ($jobs as $job)
                        <div class="mb-4 p-4 border rounded-lg">
                            <h3 class="text-xl font-bold">{{ $job->title }}</h3>
                            <p class="text-gray-600">{{ $job->location }} • {{ $job->type }}</p>
                            <p class="mt-2">{{ Str::limit($job->description, 150) }}</p>
                            <a href="{{ route('jobs.show', $job) }}" 
                               class="mt-2 inline-block text-blue-500">View Details</a>
                        </div>
                    @endforeach

                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>