<?php

namespace Connectiv\ThaiTax\Tests\Unit;

use Connectiv\ThaiTax\Facades\ThaiTax;
use Connectiv\ThaiTax\Tests\TestCase;
use Exception;

class InvalidUseTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

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
