<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Seeker Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Overview Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <!-- Profile Photo -->
                            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                @if(auth()->user()->jobSeekerProfile?->photo_path)
                                    <img src="{{ Storage::url(auth()->user()->jobSeekerProfile->photo_path) }}" 
                                         class="w-20 h-20 rounded-full object-cover">
                                @else
                                    <span class="text-2xl text-gray-500">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </span>
                                @endif
                            </div>
                            <!-- Basic Info -->
                            <div class="ml-4">
                                <h3 class="text-xl font-bold">{{ auth()->user()->name }}</h3>
                                <p class="text-gray-600">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <a href="{{ route('job-seeker.profile') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Complete Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Profile Completion -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-4">Profile Completion</h3>
                        <!-- Add profile completion percentage logic here -->
                        <div class="relative pt-1">
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                                <div style="width:30%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                            </div>
                        </div>
                        <a href="{{ route('job-seeker.profile') }}" class="text-blue-600 hover:text-blue-800">
                            Complete your profile →
                        </a>
                    </div>
                </div>

                <!-- Job Search -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-4">Job Search</h3>
                        <a href="{{ route('jobs.search') }}" 
                           class="block w-full bg-green-500 hover:bg-green-700 text-white text-center font-bold py-2 px-4 rounded">
                            Search Jobs
                        </a>
                    </div>
                </div>

                <!-- Applications -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg mb-4">My Applications</h3>
                        <a href="{{ route('job-seeker.applications') }}" 
                           class="block w-full bg-yellow-500 hover:bg-yellow-700 text-white text-center font-bold py-2 px-4 rounded">
                            View Applications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-4">Recent Activity</h3>
                    <!-- Add recent applications or viewed jobs here -->
                    <div class="space-y-4">
                        <!-- Example activity items -->
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-gray-600">You viewed Software Developer position at Tech Corp</p>
                            <p class="text-sm text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>