@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                Manage your events from here. <span class="text-blue-600">Create, Update, or View existing Events.</span>
            </h1>
        </div>
        <div class="mt-12 max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-3xl font-semibold text-gray-900 mb-6">Create New Event</h2>
            <form action="{{ route('event.post') }}" method="POST" class="space-y-6">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-semibold text-gray-700">Event Name</label>
                    <input type="text" id="title" name="title" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                           placeholder="Enter the event name">
                    @error('title')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="date" class="block text-sm font-semibold text-gray-700">Event Date</label>
                    <input type="date" id="date" name="date" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    @error('date')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="time" class="block text-sm font-semibold text-gray-700">Event Time</label>
                    <input type="time" id="time" name="time" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    @error('time')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-sm font-semibold text-gray-700">Event Location</label>
                    <input type="text" id="location" name="location" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                           placeholder="Enter the event location">
                    @error('location')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="capacity" class="block text-sm font-semibold text-gray-700">Event Capacity</label>
                    <input type="number" id="capacity" name="capacity" required 
                           class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                           placeholder="Enter the event capacity">
                    @error('capacity')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700">Event Description</label>
                    <textarea id="description" name="description" rows="5" required 
                              class="w-full p-4 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200" 
                              placeholder="Provide a detailed description of the event"></textarea>
                    @error('description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <button type="submit" 
                        class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    Create Event
                </button>
            </form>                     
        </div>
    </div>
@endsection
