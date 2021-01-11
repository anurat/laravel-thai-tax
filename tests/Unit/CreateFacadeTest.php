<?php

namespace Anurat\ThaiTax\Tests\Unit;

use Anurat\ThaiTax\Facades\ThaiTax;
use Anurat\ThaiTax\TaxCalculation;
use Anurat\ThaiTax\Tests\TestCase;

class CreateFacadeTest extends TestCase
{
    public function testCreateFacade()
    {
        $this->assertInstanceOf(TaxCalculation::class, ThaiTax::thaiYear(2564));
        $this->assertInstanceOf(TaxCalculation::class, ThaiTax::netIncome(600000));
    }
}
