<?php

namespace Anurat\ThaiTax\Tests\Unit;

use Anurat\ThaiTax\Facades\ThaiTax;
use Anurat\ThaiTax\Tests\TestCase;

class ThaiYear2542Test extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testYear2542()
    {
        $thaiTax = ThaiTax::thaiYear(2542);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(0.05, $thaiTax->netIncome(50001)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(2500.1, $thaiTax->netIncome(100001)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(42500.2, $thaiTax->netIncome(500001)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(142500.3, $thaiTax->netIncome(1000001)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1042500.37, $thaiTax->netIncome(4000001)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2543()
    {
        $thaiTax = ThaiTax::thaiYear(2543);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2544()
    {
        $thaiTax = ThaiTax::thaiYear(2544);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2545()
    {
        $thaiTax = ThaiTax::thaiYear(2545);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2546()
    {
        $thaiTax = ThaiTax::thaiYear(2546);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2547()
    {
        $thaiTax = ThaiTax::thaiYear(2547);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2548()
    {
        $thaiTax = ThaiTax::thaiYear(2548);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2549()
    {
        $thaiTax = ThaiTax::thaiYear(2549);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2550()
    {
        $thaiTax = ThaiTax::thaiYear(2550);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }

    public function testYear2551()
    {
        $thaiTax = ThaiTax::thaiYear(2551);

        $this->assertEquals(0, $thaiTax->netIncome(0)->incomeTax());
        $this->assertEquals(0, $thaiTax->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, $thaiTax->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, $thaiTax->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, $thaiTax->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, $thaiTax->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, $thaiTax->netIncome(5000000)->incomeTax());
    }
}
