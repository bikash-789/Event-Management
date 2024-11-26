@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-10 h-[100vh]">
    <h1 class="text-3xl font-bold mb-6">Bookings & Attendees</h1>
    <div class="bg-white rounded-lg shadow-lg p-6 mb-10">
        <h2 class="text-2xl font-semibold mb-4">Bookings</h2>
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Event</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">User</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Booking Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $index => $booking)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->event->title ?? 'Event not found' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->user->name ?? 'User not found' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->booking_date }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <form method="POST" action="{{ route('v1.booking.update', ['id' => $booking->id]) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()">
                                <option value="pending" {{ $booking->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status === 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $booking->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Attendees</h2>
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Event</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">User</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Verification Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendees as $index => $attendee)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $attendee->event->title ?? 'Event not found' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $attendee->user->name ?? 'User not found' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $attendee->getVerificationStatus() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
