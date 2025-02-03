<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold mb-4">Latest Encoding Jobs</h2>
    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Job ID</th>
                <th class="border p-2">Input</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jobs as $job)
                <tr>
                    <td class="border p-2">{{ $job->id }}</td>
                    <td class="border p-2 truncate w-40">
                        <a href="{{ $job->input }}" class="text-blue-500" target="_blank">{{ Str::limit($job->input, 30) }}</a>
                    </td>
                    <td class="border p-2">
                        <span class="px-2 py-1 rounded text-white 
                            {{ $job->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500' }}">
                            {{ ucfirst($job->status) }}
                        </span>
                    </td>
                    <td class="border p-2">{{ $job->created_at->diffForHumans() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-4 text-gray-500">No encoding jobs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</x-app-layout>
