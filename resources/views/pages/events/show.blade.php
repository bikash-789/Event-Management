@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-10 h-[100vh]">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg border border-gray-200 p-8">
        <div class="mb-6 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900">
                {{ $title }}
            </h1>
            <p class="text-lg text-gray-600 mt-2">
                Location: <span class="font-semibold">{{ $location }}</span>
            </p>
        </div>
        <div class="border-t border-gray-300 pt-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Event Details</h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                {{ $description }}
            </p>
        </div>
        <div class="mt-6">
            <p class="text-gray-600">
                <strong>Date:</strong> {{ $date }}
            </p>
        </div>
        <div class="mt-8 flex justify-end space-x-4">
            @if ($isAdmin)
                <a href="{{ route('pages.event.edit', $id) }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-md shadow transition">
                    Edit Event
                </a>
                <form action="{{ route('event.destroy', $id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md shadow transition">
                        Delete Event
                    </button>
                </form>
            @endif
            <a href="{{ route('pages.events.index') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md shadow transition">
                Back to Events
            </a>
        </div>
    </div>
</div>
@endsection
