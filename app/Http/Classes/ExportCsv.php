<?php

namespace App\Http\Classes;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;
use Carbon\Carbon;

class ExportCsv
{
    public function exportCSV($excel)
    {
        $booking = collect($excel);
        return Excel::store(new BookingsExport($booking), 'Booking-' . Carbon::now() . '.csv');
    }
}