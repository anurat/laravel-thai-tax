<?php

namespace Anurat\ThaiTax\Tests\Unit;

use Anurat\ThaiTax\Facades\ThaiTax;
use Anurat\ThaiTax\Tests\TestCase;

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
        $this->assertEquals(0, ThaiTax::thaiYear(2560)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2560)->netIncome(150000)->incomeTax());
        $this->assertEquals(0.05, ThaiTax::thaiYear(2560)->netIncome(150001)->incomeTax());
        $this->assertEquals(7500, ThaiTax::thaiYear(2560)->netIncome(300000)->incomeTax());
        $this->assertEquals(7500.1, ThaiTax::thaiYear(2560)->netIncome(300001)->incomeTax());
        $this->assertEquals(27500, ThaiTax::thaiYear(2560)->netIncome(500000)->incomeTax());
        $this->assertEquals(27500.15, ThaiTax::thaiYear(2560)->netIncome(500001)->incomeTax());
        $this->assertEquals(65000, ThaiTax::thaiYear(2560)->netIncome(750000)->incomeTax());
        $this->assertEquals(65000.2, ThaiTax::thaiYear(2560)->netIncome(750001)->incomeTax());
        $this->assertEquals(115000, ThaiTax::thaiYear(2560)->netIncome(1000000)->incomeTax());
        $this->assertEquals(115000.25, ThaiTax::thaiYear(2560)->netIncome(1000001)->incomeTax());
        $this->assertEquals(365000, ThaiTax::thaiYear(2560)->netIncome(2000000)->incomeTax());
        $this->assertEquals(365000.3, ThaiTax::thaiYear(2560)->netIncome(2000001)->incomeTax());
        $this->assertEquals(1265000, ThaiTax::thaiYear(2560)->netIncome(5000000)->incomeTax());
        $this->assertEquals(1265000.35, ThaiTax::thaiYear(2560)->netIncome(5000001)->incomeTax());
        $this->assertEquals(3015000, ThaiTax::thaiYear(2560)->netIncome(10000000)->incomeTax());
    }

    public function testYear2561()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2561)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2561)->netIncome(150000)->incomeTax());
        $this->assertEquals(7500, ThaiTax::thaiYear(2561)->netIncome(300000)->incomeTax());
        $this->assertEquals(27500, ThaiTax::thaiYear(2561)->netIncome(500000)->incomeTax());
        $this->assertEquals(65000, ThaiTax::thaiYear(2561)->netIncome(750000)->incomeTax());
        $this->assertEquals(115000, ThaiTax::thaiYear(2561)->netIncome(1000000)->incomeTax());
        $this->assertEquals(365000, ThaiTax::thaiYear(2561)->netIncome(2000000)->incomeTax());
        $this->assertEquals(1265000, ThaiTax::thaiYear(2561)->netIncome(5000000)->incomeTax());
        $this->assertEquals(3015000, ThaiTax::thaiYear(2561)->netIncome(10000000)->incomeTax());
    }

    public function testYear2562()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2562)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2562)->netIncome(150000)->incomeTax());
        $this->assertEquals(7500, ThaiTax::thaiYear(2562)->netIncome(300000)->incomeTax());
        $this->assertEquals(27500, ThaiTax::thaiYear(2562)->netIncome(500000)->incomeTax());
        $this->assertEquals(65000, ThaiTax::thaiYear(2562)->netIncome(750000)->incomeTax());
        $this->assertEquals(115000, ThaiTax::thaiYear(2562)->netIncome(1000000)->incomeTax());
        $this->assertEquals(365000, ThaiTax::thaiYear(2562)->netIncome(2000000)->incomeTax());
        $this->assertEquals(1265000, ThaiTax::thaiYear(2562)->netIncome(5000000)->incomeTax());
        $this->assertEquals(3015000, ThaiTax::thaiYear(2562)->netIncome(10000000)->incomeTax());
    }

    public function testYear2563()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2563)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2563)->netIncome(150000)->incomeTax());
        $this->assertEquals(7500, ThaiTax::thaiYear(2563)->netIncome(300000)->incomeTax());
        $this->assertEquals(27500, ThaiTax::thaiYear(2563)->netIncome(500000)->incomeTax());
        $this->assertEquals(65000, ThaiTax::thaiYear(2563)->netIncome(750000)->incomeTax());
        $this->assertEquals(115000, ThaiTax::thaiYear(2563)->netIncome(1000000)->incomeTax());
        $this->assertEquals(365000, ThaiTax::thaiYear(2563)->netIncome(2000000)->incomeTax());
        $this->assertEquals(1265000, ThaiTax::thaiYear(2563)->netIncome(5000000)->incomeTax());
        $this->assertEquals(3015000, ThaiTax::thaiYear(2563)->netIncome(10000000)->incomeTax());
    }

    public function testYear2564()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2564)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2564)->netIncome(150000)->incomeTax());
        $this->assertEquals(7500, ThaiTax::thaiYear(2564)->netIncome(300000)->incomeTax());
        $this->assertEquals(27500, ThaiTax::thaiYear(2564)->netIncome(500000)->incomeTax());
        $this->assertEquals(65000, ThaiTax::thaiYear(2564)->netIncome(750000)->incomeTax());
        $this->assertEquals(115000, ThaiTax::thaiYear(2564)->netIncome(1000000)->incomeTax());
        $this->assertEquals(365000, ThaiTax::thaiYear(2564)->netIncome(2000000)->incomeTax());
        $this->assertEquals(1265000, ThaiTax::thaiYear(2564)->netIncome(5000000)->incomeTax());
        $this->assertEquals(3015000, ThaiTax::thaiYear(2564)->netIncome(10000000)->incomeTax());
    }
}
