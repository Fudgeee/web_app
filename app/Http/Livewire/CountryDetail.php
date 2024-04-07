<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Country;
use App\Models\CurrencyRate;

class CountryDetail extends Component
{
    public $country;

    public function render($countryId) {
        $this->country = Country::findOrFail($countryId);

        $currencyCode = $this->country->currency;
        $lastRate = null;
        $previousRate = null;
        $percentageChange = null;
        $changeDirection = null;

        if ($currencyCode) {
            if ($currencyCode == "EUR") {
                $rate = 1.00;
                $lastRate = (number_format($rate, 2));
                $percentageChange = null;
                $changeDirection = null;
            }
            else {
                // Get the latest rate
                $lastRate = CurrencyRate::where('currency', $currencyCode)
                                        ->orderBy('date', 'desc')
                                        ->first();
        
                if ($lastRate) {
                    // Get the previous rate
                    $previousRate = CurrencyRate::where('currency', $currencyCode)
                                                ->where('date', '<', $lastRate->date)
                                                ->orderBy('date', 'desc')
                                                ->first();

                    if ($previousRate && $lastRate->rate && $previousRate->rate) {
                        $previousRateValue = $previousRate->rate;
                        $lastRateValue = $lastRate->rate;
                
                        // Calculate percentage change
                        if ($previousRateValue < $lastRateValue) {
                            $percentageChange = (($lastRateValue - $previousRateValue) / $previousRateValue) * 100;
                            $changeDirection = 'up';
                        } else {
                            $percentageChange = (($previousRateValue - $lastRateValue) / $previousRateValue) * 100;
                            $changeDirection = 'down';
                        }
                    }
                }
            }
        }

        return view('livewire.country-detail', [
            'country' => $this->country,
            'lastRate' => $lastRate,
            'previousRate' => $previousRate,
            'percentageChange' => $percentageChange,
            'changeDirection' => $changeDirection
        ]);
    }
}
