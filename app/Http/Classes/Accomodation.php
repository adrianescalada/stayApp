<?php

namespace App\Http\Classes;

use App\Models\Accomodation as AccomodationModel;
use Illuminate\Support\Facades\Log;
use Throwable;

class Accomodation
{

    public function saveAccomodation($data)
    {
        try {
            AccomodationModel::updateOrCreate([
                'hotel_id' => $data['hotel_id'],
                'hotel_name' => $data['hotel_name']
            ]);
        } catch (Throwable $th) {
            Log::error($th, ['accomodaion' => $th]);
        }
    }
}