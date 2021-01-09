<?php

namespace Connectiv\ThaiTax\Tests\Unit;

use Connectiv\ThaiTax\Facades\ThaiTax;
use Connectiv\ThaiTax\TaxCalculation;
use Connectiv\ThaiTax\Tests\TestCase;

class CreateFacadeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCreateFacade()
    {
        $this->assertInstanceOf(TaxCalculation::class, ThaiTax::thaiYear(2564));
        $this->assertInstanceOf(TaxCalculation::class, ThaiTax::netIncome(600000));
    }
}
