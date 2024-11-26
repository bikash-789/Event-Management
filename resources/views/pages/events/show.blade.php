@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-10 h-[100vh] flex items-center justify-center">
    <div class="max-w-4xl w-full mx-auto rounded-lg shadow-lg border border-gray-200 p-8 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 text-white">
        <div class="mb-6 text-center">
            <h1 class="text-4xl font-extrabold">
                {{ $title }}
            </h1>
            <p class="text-lg mt-2">
                Location: <span class="font-semibold">{{ $location }}</span>
            </p>
        </div>
        <div class="border-t border-gray-300 pt-6 border-opacity-50">
            <h2 class="text-2xl font-semibold mb-4">Event Details</h2>
            <p class="text-lg leading-relaxed">
                {{ $description }}
            </p>
        </div>
        <div class="mt-6">
            <p>
                <strong>Date:</strong> {{ $date }}
            </p>
            <p class="mt-2">
                <strong>Time:</strong> {{ $time }}
            </p>
        </div>
        <div class="mt-8 flex justify-end space-x-4">
            @if ($isAdmin)
                <a href="{{ route('v1.pages.event.edit', $id) }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-md shadow-md transition-transform transform hover:scale-105">
                    Edit Event
                </a>
                <form action="{{ route('v1.event.destroy', $id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md shadow-md transition-transform transform hover:scale-105">
                        Delete Event
                    </button>
                </form>
            @endif
            @if(!$isAdmin)
            <form action="{{ route('v1.booking.post', $id) }}" method="POST" onsubmit="return confirm('Are you sure you want to book this event?');">
                @csrf
                <button type="submit" 
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-md shadow-md transition-transform transform hover:scale-105">
                    Book now
                </button>
            </form>
            @endif
            <a href="{{ route('v1.pages.events.index') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md shadow-md transition-transform transform hover:scale-105">
                Back to Events
            </a>
        </div>
    </div>
</div>
@endsection
