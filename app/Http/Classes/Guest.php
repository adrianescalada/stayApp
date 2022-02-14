<?php

namespace App\Http\Classes;

use App\Models\Country;
use App\Models\Guest as GuestModel;
use Illuminate\Support\Facades\Log;
use Throwable;

class Guest
{
    public function saveGuest($data)
    {
        $country = Country::where('code', ($data['guest']['country']))->first();
        try {
            if (!$country) {
                $country = Country::create(
                    [
                        'name' => '-',
                        'code' => $data['guest']['country']
                    ]
                );
            } else {
                GuestModel::updateOrCreate([
                    'name' => $data['guest']['name'],
                    'lastname' => $data['guest']['lastname'],
                    'birthdate' => $data['guest']['birthdate'],
                    'passport' => $data['guest']['passport'],
                    'country_id' => $country->id
                ]);
            }
        } catch (Throwable $th) {
            Log::error($th, ['guest' => $th]);
        }
    }
}