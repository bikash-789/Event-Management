<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Event;
use App\Models\Attendee;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'user_id',    
        'event_id',
        'booking_date',
        'status',
        'verification_token',
        'verification_token_expires_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function getStatusAttribute($value)
    {
        $statuses = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'cancelled' => 'Cancelled',
        ];
        return $statuses[$value] ?? 'Unknown';
    }
    public function attendee()
    {
        return $this->hasOne(Attendee::class, 'event_id', 'event_id')->where('user_id', $this->user_id);
    }
}
