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
        $this->assertEquals(0, ThaiTax::thaiYear(2542)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2542)->netIncome(50000)->incomeTax());
        $this->assertEquals(0.05, ThaiTax::thaiYear(2542)->netIncome(50001)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2542)->netIncome(100000)->incomeTax());
        $this->assertEquals(2500.1, ThaiTax::thaiYear(2542)->netIncome(100001)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2542)->netIncome(500000)->incomeTax());
        $this->assertEquals(42500.2, ThaiTax::thaiYear(2542)->netIncome(500001)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2542)->netIncome(1000000)->incomeTax());
        $this->assertEquals(142500.3, ThaiTax::thaiYear(2542)->netIncome(1000001)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2542)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1042500.37, ThaiTax::thaiYear(2542)->netIncome(4000001)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2542)->netIncome(5000000)->incomeTax());
    }

    public function testYear2543()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2543)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2543)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2543)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2543)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2543)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2543)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2543)->netIncome(5000000)->incomeTax());
    }

    public function testYear2544()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2544)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2544)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2544)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2544)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2544)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2544)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2544)->netIncome(5000000)->incomeTax());
    }

    public function testYear2545()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2545)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2545)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2545)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2545)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2545)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2545)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2545)->netIncome(5000000)->incomeTax());
    }

    public function testYear2546()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2546)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2546)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2546)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2546)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2546)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2546)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2546)->netIncome(5000000)->incomeTax());
    }

    public function testYear2547()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2547)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2547)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2547)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2547)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2547)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2547)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2547)->netIncome(5000000)->incomeTax());
    }

    public function testYear2548()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2548)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2548)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2548)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2548)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2548)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2548)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2548)->netIncome(5000000)->incomeTax());
    }

    public function testYear2549()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2549)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2549)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2549)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2549)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2549)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2549)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2549)->netIncome(5000000)->incomeTax());
    }

    public function testYear2550()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2550)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2550)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2550)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2550)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2550)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2550)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2550)->netIncome(5000000)->incomeTax());
    }

    public function testYear2551()
    {
        $this->assertEquals(0, ThaiTax::thaiYear(2551)->netIncome(0)->incomeTax());
        $this->assertEquals(0, ThaiTax::thaiYear(2551)->netIncome(50000)->incomeTax());
        $this->assertEquals(2500, ThaiTax::thaiYear(2551)->netIncome(100000)->incomeTax());
        $this->assertEquals(42500, ThaiTax::thaiYear(2551)->netIncome(500000)->incomeTax());
        $this->assertEquals(142500, ThaiTax::thaiYear(2551)->netIncome(1000000)->incomeTax());
        $this->assertEquals(1042500, ThaiTax::thaiYear(2551)->netIncome(4000000)->incomeTax());
        $this->assertEquals(1412500, ThaiTax::thaiYear(2551)->netIncome(5000000)->incomeTax());
    }
}
