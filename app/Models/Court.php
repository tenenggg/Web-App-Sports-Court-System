<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'name',
        'sport_type',
        'description',
        'hourly_rate'
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    // Add this relationship for future bookings
    public function bookings()
    {
        return $this->hasMany(Bookcourt::class);
    }
}