@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-10 h-[100vh]">
    <h1 class="text-3xl font-bold mb-6">My Bookings</h1>

    @if ($bookings->isEmpty())
        <div class="bg-white rounded-lg shadow-lg p-6">
            <p class="text-lg text-gray-600">You have no bookings yet.</p>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-6">
            <table class="w-full table-auto border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Event</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Booking Date</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $index => $booking)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $booking->event->title ?? 'Event not found' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $booking->booking_date }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($booking->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
