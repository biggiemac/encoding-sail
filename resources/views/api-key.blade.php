<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('API Keys') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Your API Keys</h3>

                <!-- Display API Keys -->
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Created At</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tokens as $token)
                            <tr class="border border-gray-300">
                                <td class="border border-gray-300 px-4 py-2">{{ $token->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $token->created_at->format('Y-m-d H:i') }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <form method="POST" action="{{ url('/api-keys/' . $token->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-1 bg-red-500 text-white rounded">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Create API Key Form -->
                <h3 class="text-lg font-semibold mt-6 mb-2">Create a New API Key</h3>
                <form method="POST" action="{{ url('/api-keys') }}" class="mt-4">
                    @csrf
                    <div class="flex items-center">
                        <input type="text" name="name" class="border border-gray-300 p-2 rounded mr-2" placeholder="API Key Name" required>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Create</button>
                    </div>
                </form>

                <!-- Display Generated API Key -->
                @if(session('token'))
                    <div class="mt-4 p-4 bg-green-100 border border-green-300 rounded">
                        <strong>Your API Key:</strong>
                        <code class="block text-gray-700 break-all">{{ session('token') }}</code>
                        <p class="text-sm text-gray-600 mt-2">Copy this key now. You won't be able to see it again.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>