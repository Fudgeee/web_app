<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CountryList;
use App\Http\Livewire\CountryDetail;

Route::get('/', [CountryList::class, 'render'])->name('country.list');
Route::get('/country-detail/{id}', [CountryDetail::class, 'render'])->name('country.detail');
