<?php

namespace Anurat\ThaiTax\Facades;

use Illuminate\Support\Facades\Facade;

class ThaiTax extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'thaiTax';
    }
}
