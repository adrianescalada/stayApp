<?php

namespace App\Models;

use App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    protected $fillable          = ['hotel_id', 'hotel_name'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}