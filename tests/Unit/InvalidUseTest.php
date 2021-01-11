<?php

namespace Anurat\ThaiTax\Tests\Unit;

use Anurat\ThaiTax\Facades\ThaiTax;
use Anurat\ThaiTax\Tests\TestCase;
use Exception;

class InvalidUseTest extends TestCase
{
    public function testWithoutNetIncome()
    {
        $this->expectException(Exception::class);

        $tax = ThaiTax::thaiYear(2564)
            ->incomeTax();
    }

    public function testWrongThaiYear()
    {
        $this->expectException(Exception::class);

        $tax = ThaiTax::thaiYear(2535)
            ->netIncome(600000)
            ->incomeTax();
    }

    public function testWrongNetIncome()
    {
        $this->expectException(Exception::class);

        $tax = ThaiTax::thaiYear(2564)
            ->netIncome(-100000)
            ->incomeTax();
    }
}
