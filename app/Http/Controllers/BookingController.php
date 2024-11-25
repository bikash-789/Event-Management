<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Attendee;
use App\Mail\BookingVerificationMail;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $allBookings = Booking::with(['event', 'user', 'attendee'])->get();
        $allAttendees = Attendee::with(['event', 'user'])->get();
        return view('pages.bookings.index', [
            'bookings' => $allBookings,
            'attendees' => $allAttendees,
        ]);
    }
    public function create($id)
    {

    }
    public function store(Request $request, $eventId)
    {
        $userId = Auth::id();
        $event = Event::findOrFail($eventId);
        if (Booking::where('event_id', $eventId)->where('user_id', $userId)->exists()) {
            return redirect()->route('pages.events.index', $eventId)->with('error', 'You have already booked this event.');
        }
        $bookingCount = Booking::where('event_id', $eventId)->count();
        if ($bookingCount >= $event->capacity) {
            return redirect()->route('pages.events.index', $eventId)->with('error', 'This event is fully booked.');
        }
        Booking::create([
            'event_id' => $eventId,
            'user_id' => $userId,
            'status' => 'pending',
        ]);
        $event = Event::find($eventId);
        $user = auth()->user();
        Mail::to($user->email)->send(new BookingVerificationMail($user, $event));
        return redirect()->route('pages.events.index')->with('success', 'Booking created and verification email sent!');
    }

    public function show(Event $event)
    {

    }

    public function edit(Event $event)
    {

    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $request->validate(['status' => 'required|string|in:pending,confirmed,cancelled']);
        $booking->status = $request->input('status');
        $booking->booking_date = now();
        if ($booking->status == 'Confirmed')
        {
            $existingAttendee = Attendee::where('event_id', $booking->event_id)->where('user_id', $booking->user_id)->first();
            if ($existingAttendee) 
            {
                logger('Attendee already exists for user ' . $booking->user_id . ' and event ' . $booking->event_id);
            }
            else
            {
                $attendee = Attendee::create([
                    'event_id'=>$booking->event_id,
                    'user_id'=>$booking->user_id,
                    'is_verified'=>false,
                ]);
                logger('New attendee created with ID: ' . $attendee->id);
            }
        }
        $booking->save();
        return redirect()->route('pages.bookings.index')->with('success', 'Booking status updated successfully!');
    }

    public function verify($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        if ($booking->status === 'confirmed') {
            return redirect()->route('pages.events.index')->with('info', 'Booking already verified!');
        }
        $booking->status = 'confirmed';
        $booking->save();
        return redirect()->route('pages.events.index')->with('success', 'Booking verified successfully!');
    }

    public function destroy($id)
    {
        
    }
}
