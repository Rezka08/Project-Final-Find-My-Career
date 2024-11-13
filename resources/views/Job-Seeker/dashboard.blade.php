<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Seeker Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as Job Seeker!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ Auth::user()->name }}!</h3>
                    
                    <!-- Quick Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h4 class="font-semibold">Applications</h4>
                            <p class="text-2xl">0</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h4 class="font-semibold">Profile Completion</h4>
                            <p class="text-2xl">0%</p>
                        </div>
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h4 class="font-semibold">Jobs Matching</h4>
                            <p class="text-2xl">0</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-3">Quick Actions</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="#" class="block p-4 bg-white border rounded-lg hover:bg-gray-50">
                                <h4 class="font-semibold">Complete Your Profile</h4>
                                <p class="text-gray-600">Add your skills and experience</p>
                            </a>
                            <a href="#" class="block p-4 bg-white border rounded-lg hover:bg-gray-50">
                                <h4 class="font-semibold">Browse Jobs</h4>
                                <p class="text-gray-600">Find your next opportunity</p>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Applications -->
                    <div>
                        <h3 class="text-lg font-medium mb-3">Recent Applications</h3>
                        <div class="bg-white border rounded-lg">
                            <div class="p-4 text-gray-500 text-center">
                                No applications yet
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>