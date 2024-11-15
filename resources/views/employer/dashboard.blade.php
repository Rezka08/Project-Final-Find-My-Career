<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as Employer!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <a href="{{ route('jobs.create') }}" 
                                           class="block p-6 bg-white border rounded-lg hover:bg-gray-50">
                                            <h3 class="text-lg font-semibold">Post a New Job</h3>
                                            <p class="text-gray-600">Create a new job listing</p>
                                        </a>
                                        <a href="{{ route('jobs.index') }}" 
                                           class="block p-6 bg-white border rounded-lg hover:bg-gray-50">
                                            <h3 class="text-lg font-semibold">My Job Posts</h3>
                                            <p class="text-gray-600">View and manage your job listings</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h4 class="font-semibold">Active Jobs</h4>
                            <p class="text-2xl">0</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h4 class="font-semibold">Total Applications</h4>
                            <p class="text-2xl">0</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h4 class="font-semibold">Pending Reviews</h4>
                            <p class="text-2xl">0</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-3">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="#" class="block p-4 bg-white border rounded-lg hover:bg-gray-50">
                                <h4 class="font-semibold">Post a New Job</h4>
                                <p class="text-gray-600">Create a new job listing</p>
                            </a>
                            <a href="#" class="block p-4 bg-white border rounded-lg hover:bg-gray-50">
                                <h4 class="font-semibold">View Applications</h4>
                                <p class="text-gray-600">Review pending applications</p>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Job Posts -->
                    <div>
                        <h3 class="text-lg font-medium mb-3">Recent Job Posts</h3>
                        <div class="bg-white border rounded-lg">
                            <div class="p-4 text-gray-500 text-center">
                                No job posts yet
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>