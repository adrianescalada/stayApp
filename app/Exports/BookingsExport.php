<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class BookingsExport implements FromView, WithTitle
{
    protected $bookings;

    public function __construct($bookings)
    {
        $this->bookings = $bookings;
    }

    public function title(): string
    {
        return 'booking';
    }

    public function view(): View
    {
        return view('booking.excel', [
            'bookings' => $this->bookings,
        ]);
    }
}