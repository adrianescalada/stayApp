<?php

namespace App\Traits\Integrations;

use GuzzleHttp\Exception\GuzzleException;
use Exception;
use Illuminate\Support\Facades\Log;

class ApiStay
{
    public function __construct()
    {
        $this->url   = config('services.channels.stay.url');
    }
    public function getAccommodations($ts)
    {
        try {
            $context = stream_context_create(array('http' => array('protocol_version' => '1.1')));
            $json         = file_get_contents($this->url . '/int/pms-faker/stay/test/pms?ts=' . $ts, false, $context);
            return $json;
        } catch (Exception | GuzzleException $exception) {
            Log::error("error reading file", [$this->url]);
            return $json = null;
        }
    }
}