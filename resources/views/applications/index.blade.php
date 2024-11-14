<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applications for ') . $job->title }}
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
                    @if($applications->isEmpty())
                        <p class="text-center text-gray-500">No applications received yet.</p>
                    @else
                        @foreach($applications as $application)
                            <div class="mb-4 p-4 border rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold">{{ $application->user->name }}</h3>
                                        <p class="text-gray-600">{{ $application->user->email }}</p>
                                        <p class="mt-2">Applied on: {{ $application->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ Storage::url($application->cv_path) }}" 
                                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                           target="_blank">
                                            View CV
                                        </a>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <form action="{{ route('applications.update-status', $application) }}" 
                                          method="POST" class="flex items-end space-x-4">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <div class="flex-1">
                                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                                Status
                                            </label>
                                            <select name="status" 
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                                                <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>
                                                    Accepted
                                                </option>
                                                <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>
                                                    Rejected
                                                </option>
                                            </select>
                                        </div>

                                        <div class="flex-1">
                                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                                Note
                                            </label>
                                            <input type="text" name="note" 
                                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"
                                                   value="{{ $application->note }}">
                                        </div>

                                        <button type="submit" 
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Update Status
                                        </button>
                                    </form>
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