<?php

namespace Connectiv\ThaiTax\Tests\Unit;

use Connectiv\ThaiTax\Facades\ThaiTax;
use Connectiv\ThaiTax\Tests\TestCase;

class ThaiYear2560Test extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testYear2560()
    {
        $thaiTax = ThaiTax::thaiYear(2560);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(150000)->incomeTax());
        $this->assertEquals(0.05, $thaiTax->netIncome(150001)->incomeTax());
        $this->assertEquals(7500, $thaiTax->netIncome(300000)->incomeTax());
        $this->assertEquals(7500.1, $thaiTax->netIncome(300001)->incomeTax());
        $this->assertEquals(27500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(27500.15, $thaiTax->netIncome(500001)->incomeTax());
        $this->assertEquals(65000, $thaiTax->netIncome(750000)->incomeTax());
        $this->assertEquals(65000.2, $thaiTax->netIncome(750001)->incomeTax());
        $this->assertEquals(115000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(115000.25, $thaiTax->netIncome(1000001)->incomeTax());
        $this->assertEquals(365000, $thaiTax->netIncome(2000000)->incomeTax());
        $this->assertEquals(365000.3, $thaiTax->netIncome(2000001)->incomeTax());
        $this->assertEquals(1265000, $thaiTax->netIncome(5000000)->incomeTax());
        $this->assertEquals(1265000.35, $thaiTax->netIncome(5000001)->incomeTax());
        $this->assertEquals(3015000, $thaiTax->netIncome(10000000)->incomeTax());
    }

    public function testYear2561()
    {
        $thaiTax = ThaiTax::thaiYear(2561);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(150000)->incomeTax());
        $this->assertEquals(7500, $thaiTax->netIncome(300000)->incomeTax());
        $this->assertEquals(27500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(65000, $thaiTax->netIncome(750000)->incomeTax());
        $this->assertEquals(115000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(365000, $thaiTax->netIncome(2000000)->incomeTax());
        $this->assertEquals(1265000, $thaiTax->netIncome(5000000)->incomeTax());
        $this->assertEquals(3015000, $thaiTax->netIncome(10000000)->incomeTax());
    }

    public function testYear2562()
    {
        $thaiTax = ThaiTax::thaiYear(2562);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(150000)->incomeTax());
        $this->assertEquals(7500, $thaiTax->netIncome(300000)->incomeTax());
        $this->assertEquals(27500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(65000, $thaiTax->netIncome(750000)->incomeTax());
        $this->assertEquals(115000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(365000, $thaiTax->netIncome(2000000)->incomeTax());
        $this->assertEquals(1265000, $thaiTax->netIncome(5000000)->incomeTax());
        $this->assertEquals(3015000, $thaiTax->netIncome(10000000)->incomeTax());
    }

    public function testYear2563()
    {
        $thaiTax = ThaiTax::thaiYear(2563);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(150000)->incomeTax());
        $this->assertEquals(7500, $thaiTax->netIncome(300000)->incomeTax());
        $this->assertEquals(27500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(65000, $thaiTax->netIncome(750000)->incomeTax());
        $this->assertEquals(115000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(365000, $thaiTax->netIncome(2000000)->incomeTax());
        $this->assertEquals(1265000, $thaiTax->netIncome(5000000)->incomeTax());
        $this->assertEquals(3015000, $thaiTax->netIncome(10000000)->incomeTax());
    }

    public function testYear2564()
    {
        $thaiTax = ThaiTax::thaiYear(2564);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(150000)->incomeTax());
        $this->assertEquals(7500, $thaiTax->netIncome(300000)->incomeTax());
        $this->assertEquals(27500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(65000, $thaiTax->netIncome(750000)->incomeTax());
        $this->assertEquals(115000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(365000, $thaiTax->netIncome(2000000)->incomeTax());
        $this->assertEquals(1265000, $thaiTax->netIncome(5000000)->incomeTax());
        $this->assertEquals(3015000, $thaiTax->netIncome(10000000)->incomeTax());
    }
}
