<?php

namespace Anurat\ThaiTax\Tests\Unit;

use Anurat\ThaiTax\Facades\ThaiTax;
use Anurat\ThaiTax\Tests\TestCase;

class ThaiYear2552Test extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testYear2552()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2552)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2552)->netIncome(150000)->incomeTax());
        $this->assertEquals(0.1, ThaiTax::thaiYear(2552)->netIncome(150001)->incomeTax());
        $this->assertEquals(35000, ThaiTax::thaiYear(2552)->netIncome(500000)->incomeTax());
        $this->assertEquals(35000.2, ThaiTax::thaiYear(2552)->netIncome(500001)->incomeTax());
        $this->assertEquals(135000, ThaiTax::thaiYear(2552)->netIncome(1000000)->incomeTax());
        $this->assertEquals(135000.3, ThaiTax::thaiYear(2552)->netIncome(1000001)->incomeTax());
        $this->assertEquals(1035000, ThaiTax::thaiYear(2552)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1035000.37, ThaiTax::thaiYear(2552)->netIncome(4000001)->incomeTax());
        $this->assertEquals(1405000, ThaiTax::thaiYear(2552)->netIncome(5000000)->incomeTax());
    }

    public function testYear2553()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2553)->netIncome(0)->incomeTax());
        $this->assertEquals(35000, ThaiTax::thaiYear(2553)->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, ThaiTax::thaiYear(2553)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, ThaiTax::thaiYear(2553)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, ThaiTax::thaiYear(2553)->netIncome(5000000)->incomeTax());
    }

    public function testYear2554()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2554)->netIncome(0)->incomeTax());
        $this->assertEquals(35000, ThaiTax::thaiYear(2554)->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, ThaiTax::thaiYear(2554)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, ThaiTax::thaiYear(2554)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, ThaiTax::thaiYear(2554)->netIncome(5000000)->incomeTax());
    }

    public function testYear2555()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2555)->netIncome(0)->incomeTax());
        $this->assertEquals(35000, ThaiTax::thaiYear(2555)->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, ThaiTax::thaiYear(2555)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, ThaiTax::thaiYear(2555)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, ThaiTax::thaiYear(2555)->netIncome(5000000)->incomeTax());
    }

    public function testYear2556()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2556)->netIncome(0)->incomeTax());
        $this->assertEquals(35000, ThaiTax::thaiYear(2556)->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, ThaiTax::thaiYear(2556)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, ThaiTax::thaiYear(2556)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, ThaiTax::thaiYear(2556)->netIncome(5000000)->incomeTax());
    }

    public function testYear2557()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2557)->netIncome(0)->incomeTax());
        $this->assertEquals(35000, ThaiTax::thaiYear(2557)->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, ThaiTax::thaiYear(2557)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, ThaiTax::thaiYear(2557)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, ThaiTax::thaiYear(2557)->netIncome(5000000)->incomeTax());
    }

    public function testYear2558()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2558)->netIncome(0)->incomeTax());
        $this->assertEquals(35000, ThaiTax::thaiYear(2558)->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, ThaiTax::thaiYear(2558)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, ThaiTax::thaiYear(2558)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, ThaiTax::thaiYear(2558)->netIncome(5000000)->incomeTax());
    }

    public function testYear2559()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2559)->netIncome(0)->incomeTax());
        $this->assertEquals(35000, ThaiTax::thaiYear(2559)->netIncome(500000)->incomeTax());
        $this->assertEquals(135000, ThaiTax::thaiYear(2559)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1035000, ThaiTax::thaiYear(2559)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1405000, ThaiTax::thaiYear(2559)->netIncome(5000000)->incomeTax());
    }
}
