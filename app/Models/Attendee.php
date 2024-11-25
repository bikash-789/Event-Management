<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Attendee extends Model
{
    use HasFactory;
    protected $table = 'attendees';
    protected $fillable = [
        'event_id',
        'user_id',
        'is_verified', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    /**
     * @return void
     */
    public function verify()
    {
        $this->is_verified = true;
        $this->save();
    }
    /**
     * @return void
     */
    public function unverify()
    {
        $this->is_verified = false;
        $this->save();
    }
    public function getVerificationStatus()
    {
        return $this->is_verified ? 'Verified' : 'Not Verified';
    }
}
