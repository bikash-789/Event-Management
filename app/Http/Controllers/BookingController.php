<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Attendee;
use App\Mail\BookingVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
    public function userbookings()
    {
        $bookings = Booking::where('user_id', auth()->id())->with('event')->get();
        return view('pages.bookings.userbookings', compact('bookings'));
    }
    public function create($id)
    {

    }
    public function store(Request $request, $eventId)
    {
        $userId = Auth::id();
        $event = Event::findOrFail($eventId);
        if (Booking::where('event_id', $eventId)->where('user_id', $userId)->exists()) {
            return redirect()->route('v1.pages.events.index', $eventId)->with('error', 'You have already booked this event.');
        }
        $bookingCount = Booking::where('event_id', $eventId)->count();
        if ($bookingCount >= $event->capacity) {
            return redirect()->route('v1.pages.events.index', $eventId)->with('error', 'This event is fully booked.');
        }
        $booking = new Booking();
        $booking->event_id = $eventId;
        $booking->user_id = $userId;
        $booking->status = 'pending';
        $booking->booking_date = now();
        $booking->verification_token = Str::random(32);
        $booking->verification_token_expires_at = now()->addHours(24);
        $booking->save();

        $event = Event::find($eventId);
        $user = auth()->user();
        $verificationUrl = route('v1.bookings.verify', ['id' => $booking->id, 'token' => $booking->verification_token]);
        Mail::send('emails.booking-verification', ['user'=>$user, 'verificationUrl'=>$verificationUrl, 'event'=>$event, 'token'=>$booking->verification_token], function ($message) use ($user) {
        $message->to($user->email)->subject('Verify Your Booking');
        });
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
        return redirect()->route('v1.pages.bookings.index')->with('success', 'Booking status updated successfully!');
    }

    public function verify($id, $token)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->verification_token_expires_at < now()) {
            return redirect()->route('pages.bookings.index')->with('error', 'Verification link has expired.');
        }
        if ($booking->verification_token === $token) {
            $booking->status = 'confirmed';
            $booking->verification_token = null;
            $booking->save();
            return redirect()->route('pages.bookings.index')->with('success', 'Booking verified successfully!');
        }
        return redirect()->route('pages.bookings.index')->with('error', 'Invalid verification link.');
    }

    public function destroy($id)
    {
        
    }
}
