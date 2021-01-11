<?php

namespace Anurat\ThaiTax\Tests\Unit;

use Anurat\ThaiTax\Facades\ThaiTax;
use Anurat\ThaiTax\Tests\TestCase;

class IncomeTest extends TestCase
{
    public function testAddIncome()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000);

        $this->assertSame(11500.0, $thaiTax->incomeTax());
    }

    public function testAddLowIncome()
    {
        $tax = ThaiTax::thaiYear(2564)
            ->income(310000)
            ->incomeTax();

        $this->assertSame(0.0, $tax);

        $tax = ThaiTax::thaiYear(2564)
            ->income(320000)
            ->incomeTax();

        $this->assertSame(500.0, $tax);
    }

    public function testAddMultipleIncomes()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(250000)
            ->income(50000)
            ->income(15000);

        $this->assertSame(250.0, $thaiTax->incomeTax());
    }

    public function testAddDifferentTypesOfIncomes()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(100000)
            ->salary(50000)
            ->bonus(50000);

        $this->assertSame(41000.0, $thaiTax->incomeTax());
    }
}
