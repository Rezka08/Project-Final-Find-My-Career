<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($applications->isEmpty())
                        <p class="text-center text-gray-500">You haven't applied to any jobs yet.</p>
                    @else
                        @foreach($applications as $application)
                            <div class="mb-4 p-4 border rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $application->jobPost->title }}</h3>
                                        <p class="text-gray-600">{{ $application->jobPost->employer->name }}</p>
                                        <p class="mt-2">Applied on: {{ $application->created_at->format('M d, Y') }}</p>
                                        <p class="mt-1">
                                            Status: 
                                            <span class="px-2 py-1 rounded text-sm
                                                {{ $application->status === 'accepted' ? 'bg-green-100 text-green-800' : 
                                                   ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                                   'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </p>
                                        @if($application->note)
                                            <p class="mt-2 text-gray-600">Note: {{ $application->note }}</p>
                                        @endif
                                    </div>
                                    <a href="{{ Storage::url($application->cv_path) }}" 
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                       target="_blank">
                                        View CV
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        {{ $applications->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>