<div class="bg-white rounded-lg shadow-md p-6 mb-4">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-xl font-bold">{{ $job->title }}</h3>
            <p class="text-gray-600">{{ $job->location }}</p>
        </div>
        <span class="px-3 py-1 rounded-full text-sm 
            {{ $job->type === 'full-time' ? 'bg-green-100 text-green-800' : 
               ($job->type === 'part-time' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
            {{ $job->type }}
        </span>
    </div>
    
    <div class="mt-4">
        <p class="text-gray-700">{{ Str::limit($job->description, 150) }}</p>
    </div>
    
    <div class="mt-4 flex justify-between items-center">
        <div class="text-gray-600">
            Salary: Rp {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }}
        </div>
        <a href="{{ route('jobs.show', $job) }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            View Details
        </a>
    </div>
</div>