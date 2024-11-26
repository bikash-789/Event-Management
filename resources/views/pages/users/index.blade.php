@extends('layouts.main')

@section('content')
    <div class="container mx-auto p-6 h-[100vh]">
        <h1 class="text-2xl font-bold mb-6">Manage Users</h1>
        
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">#</th>
                        <th class="py-2 px-4 text-left">Name</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Status</th>
                        <th class="py-2 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-2 px-4">{{ $user->id }}</td>
                            <td class="py-2 px-4">{{ $user->name }}</td>
                            <td class="py-2 px-4">{{ $user->email }}</td>
                            <td class="py-2 px-4">
                                <span class="font-semibold {{ $user->status === 'blacklisted' ? 'text-red-600' : ($user->status === 'whitelisted' ? 'text-green-600' : 'text-gray-800') }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="py-2 px-4 space-x-2">
                                @if ($user->status !== 'blacklisted')
                                    <form action="{{ route('v1.users.blacklist', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded hover:bg-red-700 transition duration-300">Blacklist</button>
                                    </form>
                                @else
                                    <form action="{{ route('v1.users.reactivate', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white py-1 px-3 rounded hover:bg-green-700 transition duration-300">Reactivate</button>
                                    </form>
                                @endif

                                @if ($user->status !== 'whitelisted')
                                    <form action="{{ route('v1.users.whitelist', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="bg-blue-600 text-white py-1 px-3 rounded hover:bg-blue-700 transition duration-300">Whitelist</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
