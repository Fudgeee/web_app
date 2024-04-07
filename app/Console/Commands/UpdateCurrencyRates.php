<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\CurrencyRate;
use Carbon\Carbon;

class UpdateCurrencyRates extends Command
{
    protected $signature = 'currency:update';
    protected $description = 'Download and update currency rates from ECB';

    // function that downloads an XML file from the ECB, parses it, and then saves the current exchange rates to the database
    public function handle()
    {
        $response = Http::get('https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');

        if ($response->ok()) {
            $xml = $response->body();
            $xmlData = simplexml_load_string($xml);

            foreach ($xmlData->Cube->Cube->Cube as $cube) {
                $currency = (string) $cube['currency'];
                $rate = (float) $cube['rate'];
                $date = Carbon::now()->toDateString(); // Current date in 'yyyy-mm-dd' format

                // Check if the same currency for today already exists
                $existingRate = CurrencyRate::where('currency', $currency)
                    ->where('date', $date)
                    ->first();

                if (!$existingRate) {
                    // Insert new rate into database
                    CurrencyRate::create([
                        'currency' => $currency,
                        'rate' => $rate,
                        'date' => $date
                    ]);
                } else {
                    // Log message about existing rate
                    $this->info("Rate for currency $currency already updated today.");
                }
            }

            $this->info('Currency rates updated successfully.');
        } else {
            $this->error('Failed to fetch currency rates from ECB.');
        }
    }
}
