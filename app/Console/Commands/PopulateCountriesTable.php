<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Country;

class PopulateCountriesTable extends Command
{
    protected $signature = 'countries:populate';
    protected $description = 'Populate countries table with data from restcountries.com API';

    public function handle()
    {
        $response = Http::get('https://restcountries.com/v3.1/region/europe');

        if ($response->ok()) {
            $countries = $response->json();

            foreach ($countries as $countryData) {
                // Extract necessary data
                $name = $countryData['name']['common'];
                $capital = $countryData['capital'][0];
                $population = $countryData['population'];
                $timezone = $countryData['timezones'][0];
                $flag = $countryData['flags']['png'];
                $currencyKeys = array_keys($countryData['currencies']);
                $currencyName = reset($currencyKeys);

                // Check if country already exists
                $existingCountry = Country::where('name', $name)->first();

                if (!$existingCountry) {
                    // Create new country if not already in database
                    Country::create([
                        'name' => $name,
                        'capital' => $capital,
                        'population' => $population,
                        'timezone' => $timezone,
                        'flag' => $flag,
                        'currency' => $currencyName
                    ]);
                } else {
                    // Log message about existing country
                    $this->info("Country '$name' already exists in database.");
                }
            }

            $this->info('Countries table populated successfully.');
        } else {
            $this->error('Failed to fetch data from the API.');
        }
    }
}
