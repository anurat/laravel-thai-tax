<?php

namespace Anurat\ThaiTax;

use Anurat\ThaiTax\TaxCalculation;
use Illuminate\Support\ServiceProvider;

class ThaiTaxServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('thaiTax', function ($app) {
            return new TaxCalculation();
        });
    }

    public function boot()
    {
        //
    }
}
