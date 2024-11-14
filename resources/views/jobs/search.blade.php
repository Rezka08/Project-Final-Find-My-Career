<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('jobs.search') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Search Input -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                                <input type="text" name="search" id="search" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       value="{{ request('search') }}" 
                                       placeholder="Job title or keywords">
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" id="location" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       value="{{ request('location') }}" 
                                       placeholder="City or region">
                            </div>

                            <!-- Job Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Job Type</label>
                                <select name="type" id="type" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="all">All Types</option>
                                    <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="freelance" {{ request('type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                </select>
                            </div>

                            <!-- Sort -->
                            <div>
                                <label for="sort" class="block text-sm font-medium text-gray-700">Sort By</label>
                                <select name="sort" id="sort" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                    <option value="salary_high" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Highest Salary</option>
                                    <option value="salary_low" {{ request('sort') == 'salary_low' ? 'selected' : '' }}>Lowest Salary</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search Jobs
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Results -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($jobs->isEmpty())
                        <p class="text-center text-gray-500">No jobs found matching your criteria.</p>
                    @else
                        <div class="space-y-6">
                            @foreach($jobs as $job)
                                <div class="border rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-xl font-bold">
                                                <a href="{{ route('jobs.show', $job) }}" class="text-blue-600 hover:text-blue-800">
                                                    {{ $job->title }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600">{{ $job->employer->name }}</p>
                                            <div class="mt-2 space-y-1">
                                                <p class="text-gray-600">
                                                    <span class="inline-block w-20">Location:</span> 
                                                    {{ $job->location }}
                                                </p>
                                                <p class="text-gray-600">
                                                    <span class="inline-block w-20">Type:</span>
                                                    <span class="px-2 py-1 text-xs rounded
                                                        {{ $job->type === 'full-time' ? 'bg-green-100 text-green-800' : 
                                                           ($job->type === 'part-time' ? 'bg-blue-100 text-blue-800' : 
                                                           'bg-yellow-100 text-yellow-800') }}">
                                                        {{ ucfirst($job->type) }}
                                                    </span>
                                                </p>
                                                <p class="text-gray-600">
                                                    <span class="inline-block w-20">Salary:</span>
                                                    Rp {{ number_format($job->salary_min) }} - Rp {{ number_format($job->salary_max) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('jobs.show', $job) }}" 
                                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-gray-600">
                                        {{ Str::limit($job->description, 200) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $jobs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>