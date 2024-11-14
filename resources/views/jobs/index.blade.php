<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Job Posts') }}
            </h2>
            <a href="{{ route('jobs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Post New Job
            </a>
        </div>
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
                    @if($jobs->isEmpty())
                        <p class="text-center text-gray-500">You haven't posted any jobs yet.</p>
                    @else
                        @foreach($jobs as $job)
                            <div class="mb-4 p-4 border rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $job->title }}</h3>
                                        <p class="text-gray-600">{{ $job->location }} • {{ $job->type }}</p>
                                        <p class="mt-2">Salary: Rp {{ number_format($job->salary_min) }} - 
                                            Rp {{ number_format($job->salary_max) }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('jobs.edit', $job) }}" 
                                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                            Edit
                                        </a>
                                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this job post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{ $jobs->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>