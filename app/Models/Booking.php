<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable          = ['locator', 'room', 'check_in', 'check_out', 'pax', 'request_item', 'accomodation_id', 'guest_id'];
}