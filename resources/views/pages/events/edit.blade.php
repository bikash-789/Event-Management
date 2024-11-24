@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                Manage your events from here. <span class="text-blue-600">Update event.</span>
            </h1>
        </div>
        <div class="mt-12 max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-900 mb-6">Update Event</h2>
            <form action="" method="POST" class="space-y-6">
                @csrf
                <div class="mb-4">
                    <label for="event_name" class="block text-sm font-semibold text-gray-700">Event Name</label>
                    <input type="text" id="event_name" name="event_name" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                           placeholder="Enter the event name">
                    @error('event_name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="event_date" class="block text-sm font-semibold text-gray-700">Event Date</label>
                    <input type="date" id="event_date" name="event_date" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    @error('event_date')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="event_location" class="block text-sm font-semibold text-gray-700">Event Location</label>
                    <input type="text" id="event_location" name="event_location" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                           placeholder="Enter the event location">
                    @error('event_location')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="event_description" class="block text-sm font-semibold text-gray-700">Event Description</label>
                    <textarea id="event_description" name="event_description" rows="5" required 
                              class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
                              placeholder="Provide a detailed description of the event"></textarea>
                    @error('event_description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" 
                        class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    Update Event
                </button>
            </form>
        </div>
    </div>
@endsection
