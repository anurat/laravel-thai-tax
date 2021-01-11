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

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2542(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2542)->netIncome($netIncome)->incomeTax());
    }

    public function provideNetIncomeData(): array
    {
        return [
            [0, 0],
            [0, 50000],
            [0.05, 50001],
            [2500, 100000],
            [2500.1, 100001],
            [42500, 500000],
            [42500.2, 500001],
            [142500, 1000000],
            [142500.3, 1000001],
            [1042500, 4000000],
            [1042500.37, 4000001],
            [1412500, 5000000],
        ];
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2543(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2543)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2544(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2544)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2545(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2545)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2546(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2546)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2547(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2547)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2548(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2548)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2549(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2549)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2550(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2550)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2551(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2551)->netIncome($netIncome)->incomeTax());
    }
}
