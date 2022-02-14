<?php

namespace App\Console\Commands;

use App\Http\Classes\Accomodation;
use App\Http\Classes\Guest;
use App\Http\Classes\Booking;
use App\Http\Classes\ExportCsv;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Traits\Integrations\ApiStay;
use App\Models\Booking as BookingModel;
use Exception;
use Illuminate\Support\Facades\Log;

class StayApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:stay {--tsDay=} {--tsHour=} {--tsToday} {--truncate}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'api stay app';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiStay = new ApiStay;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ts = 0;

        $tsDay      = $this->option('tsDay');
        $tsHour      = $this->option('tsHour');
        $tsToday      = $this->option('tsToday');
        $truncate      = $this->option('truncate');

        $accomodation = new Accomodation();
        $guest = new Guest();
        $booking = new Booking();

        if ($truncate) {
            $booking->truncate();
        }
        if ($tsDay && $tsHour) {
            $day = $tsDay . ' ' . $tsHour;
            try {
                $ts = Carbon::createFromFormat('d/m/Y H:i', $day)->timestamp;
            } catch (Exception $exp) {
                Log::error("error format date");
                dd($exp->getMessage());
            }
        }
        if ($tsToday) {
            $ts = Carbon::now()->timestamp;
        }

        $request  = $this->apiStay->getAccommodations($ts);
        $response = collect(json_decode($request, true));
        $excel = [];
        if (!$response->isEmpty()) {
            foreach ($response['bookings'] as $item) {
                $accomodation->saveAccomodation($item);
                $guest->saveGuest($item);
                $book = BookingModel::where('locator', $item['booking']['locator'])->first();
                if (!$book) {
                    array_push($excel, $item);
                }
                $booking->saveBooking($item);
            }
            $export = new ExportCsv();
            $export->exportCSV($excel);
        }
    }
}