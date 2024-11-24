@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-10 h-[100vh]">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                Welcome to <span class="text-blue-600">Event Management</span>
            </h1>
            <p class="text-lg text-gray-600 leading-relaxed">
                Discover all the events happening around you, and use our platform to easily book tickets.
            </p>
        </div>
        <a href=""></button>
        <div class="mt-10">
            @foreach ($events as $event)
                <x-card :title="$event->title" :description="$event->description">
                    <div class="flex-col gap-1 justify-start">
                    <span class="block">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</span>
                    <br/>
                    <a href="{{ route('events.show', $event->id) }}" class="bg-blue-500 text-white px-6 py-2 rounded-md shadow hover:bg-blue-600 transition">
                        View Event
                    </a>
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>
@endsection
