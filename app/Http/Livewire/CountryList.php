<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Country;

class CountryList extends Component
{
    public function render() {
        $countries = Country::all();

        return view('livewire.country-list', [
            'countries' => $countries
        ]);
    }
}
