<?php


namespace App\Http\Classes;

use App\Models\Booking as BookinModel;
use App\Models\Accomodation;
use App\Models\Guest;
use Illuminate\Support\Facades\Log;
use Throwable;

class Booking
{
    public function saveBooking($data)
    {
        $guest = Guest::where('passport', ($data['guest']['passport']))->first();
        $accomodation = Accomodation::with('bookings')->where('hotel_id', ($data['hotel_id']))->first();
        try {
            BookinModel::updateOrCreate([
                'locator' => $data['booking']['locator'],
                'room' => $data['booking']['room'],
                'check_in' => $data['booking']['check_in'],
                'check_out' => $data['booking']['check_out'],
                'pax' => json_encode($data['booking']['pax']),
                'request_item' =>  json_encode($data),
                'guest_id' =>  $guest->id,
                'accomodation_id' =>  $accomodation->id,
            ]);
        } catch (Throwable $th) {
            Log::error($th, ['booking' => $th]);
        }
    }

    public function truncate()
    {
        BookinModel::truncate();
    }
}