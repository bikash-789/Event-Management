<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('pages.events.index', compact('events'));
    }
    public function create()
    {
        $events = Event::all();
        return view('pages.events.create', compact('events'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
        ]);
        $event = new Event($validatedData);
        $event->created_by = Auth::id();
        $event->save();
        return redirect()->route('pages.events.index')->with('success', 'Event created successfully.');
    }
    public function show(Event $event)
    {
        $isAdmin = Auth::check() && Auth::user()->role == 'user';
        return view('pages.events.show', [
            'title' => $event->title,
            'location' => $event->location,
            'description' => $event->description,
            'date' => \Carbon\Carbon::parse($event->date)->format('F j, Y'),
            'isAdmin' => $isAdmin,
            'eventId' => $event->id,
        ]);
    }

    public function edit(Event $event)
    {
        return view('pages.events.edit', compact('event'));
    }
    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date|after:today',
            'time' => 'required|date_format:H:i',
        ]);

        $event->update($validatedData);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
