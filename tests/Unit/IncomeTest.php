<?php

namespace Connectiv\ThaiTax\Tests\Unit;

use Connectiv\ThaiTax\Facades\ThaiTax;
use Connectiv\ThaiTax\Tests\TestCase;

class IncomeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testAddIncome()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000);

        $this->assertEquals(17500, $thaiTax->incomeTax());
    }

    public function testAddLowIncome()
    {
        $tax = ThaiTax::thaiYear(2564)
            ->income(250000)
            ->incomeTax();

        $this->assertEquals(0, $tax);

        $tax = ThaiTax::clear()
            ->thaiYear(2564)
            ->income(260000)
            ->incomeTax();

        $this->assertEquals(500, $tax);
    }

    public function testAddMultipleIncomes()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(200000)
            ->income(50000)
            ->income(3000);

        $this->assertEquals(150, $thaiTax->incomeTax());
    }

    public function testAddDifferentTypesOfIncomes()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(100000)
            ->salary(500000)
            ->bonus(50000);

        $this->assertEquals(35000, $thaiTax->incomeTax());
    }
}
