<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\User;
use App\Models\Attendee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_has_fillable_properties()
    {
        $event = Event::create([
            'title' => 'Laravel Meetup',
            'description' => 'A meetup for Laravel enthusiasts.',
            'location' => 'Online',
            'date' => '2024-12-15',
            'time' => '18:00:00',
            'capacity' => 100,
            'created_by' => 1,
        ]);

        $this->assertDatabaseHas('events', [
            'title' => 'Laravel Meetup',
            'description' => 'A meetup for Laravel enthusiasts.',
        ]);
    }

    #[Test]
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['created_by' => $user->id]);
        $this->assertTrue($event->user->is($user));
    }

    #[Test]
    public function it_has_many_attendees()
    {
        $event = Event::factory()->create();
        $attendees = Attendee::factory()->count(5)->create(['event_id' => $event->id]);
        $this->assertCount(5, $event->attendees);
        $this->assertTrue($event->attendees->contains($attendees->first()));
    }

    #[Test]
    public function it_can_scope_events_on_a_specific_date()
    {
        $eventToday = Event::factory()->create(['date' => now()->format('Y-m-d')]);
        $eventTomorrow = Event::factory()->create(['date' => now()->addDay()->format('Y-m-d')]);
        $scopedEvents = Event::onDate(now()->format('Y-m-d'))->get(); // scope method : `onDate` defined in Event model
        $this->assertTrue($scopedEvents->contains($eventToday));
        $this->assertFalse($scopedEvents->contains($eventTomorrow));
    }

    #[Test]
    public function it_can_scope_upcoming_events()
    {
        $pastEvent = Event::factory()->create(['date' => now()->subDay()->format('Y-m-d')]);
        $upcomingEvent = Event::factory()->create(['date' => now()->addDay()->format('Y-m-d')]);
        $scopedEvents = Event::upcoming()->get(); // scope method : `upcoming` defined in Event model
        $this->assertTrue($scopedEvents->contains($upcomingEvent));
        $this->assertFalse($scopedEvents->contains($pastEvent));
    }

    #[Test]
    public function it_can_scope_past_events()
    {
        $pastEvent = Event::factory()->create(['date' => now()->subDay()->format('Y-m-d')]);
        $upcomingEvent = Event::factory()->create(['date' => now()->addDay()->format('Y-m-d')]);
        $scopedEvents = Event::past()->get(); // scope method : `past` defined in Event model
        $this->assertTrue($scopedEvents->contains($pastEvent));
        $this->assertFalse($scopedEvents->contains($upcomingEvent));
    }

    #[Test]
    public function it_casts_date_and_time_correctly()
    {
        $event = Event::create([
            'title' => 'Test Event',
            'description' => 'Testing date and time casts.',
            'location' => 'Test Location',
            'date' => '2024-12-15',
            'time' => '18:00:00',
            'capacity' => 100,
            'created_by' => 1,
        ]);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $event->date);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $event->time);
    }
}
