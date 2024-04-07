<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyRatesTable extends Migration
{
    public function up() {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();
            $table->string('currency');
            $table->float('rate');
            $table->date('date');
        });
    }

    public function down() {
        Schema::dropIfExists('currency_rates');
    }
}
