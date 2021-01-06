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

        $this->assertEquals(11500, $thaiTax->incomeTax());
    }

    public function testAddLowIncome()
    {
        $tax = ThaiTax::thaiYear(2564)
            ->income(310000)
            ->incomeTax();

        $this->assertEquals(0, $tax);

        ThaiTax::clearData();
        $tax = ThaiTax::thaiYear(2564)
            ->income(320000)
            ->incomeTax();

        $this->assertEquals(500, $tax);
    }

    public function testAddMultipleIncomes()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(250000)
            ->income(50000)
            ->income(15000);

        $this->assertEquals(250, $thaiTax->incomeTax());
    }

    public function testAddDifferentTypesOfIncomes()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(100000)
            ->salary(50000)
            ->bonus(50000);

        $this->assertEquals(41000, $thaiTax->incomeTax());
    }
}
