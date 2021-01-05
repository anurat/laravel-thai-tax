<?php

namespace Connectiv\ThaiTax\Tests\Unit;

use Connectiv\ThaiTax\Facades\ThaiTax;
use Connectiv\ThaiTax\Tests\TestCase;

class ThaiYear2556Test extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testYear2556()
    {
        $thaiTax = ThaiTax::thaiYear(2556);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(150000)->incomeTax());
        $this->assertEquals(0.1, $thaiTax->netIncome(150001)->incomeTax());
        $this->assertEquals(35000, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(35000.2, $thaiTax->netIncome(500001)->incomeTax());
        $this->assertEquals(135000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(135000.3, $thaiTax->netIncome(1000001)->incomeTax());
        $this->assertEquals(1035000, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1035000.37, $thaiTax->netIncome(4000001)->incomeTax());
        $this->assertEquals(1405000, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2557()
    {
        $thaiTax = ThaiTax::thaiYear(2557);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(35000, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2558()
    {
        $thaiTax = ThaiTax::thaiYear(2558);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(35000, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2559()
    {
        $thaiTax = ThaiTax::thaiYear(2559);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(35000, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, $thaiTax->netIncome(5000000)->incomeTax());
    }
}
