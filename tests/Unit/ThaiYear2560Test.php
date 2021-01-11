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

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2560(float $expectedResult, float $netIncome): void
    {
        $this->assertSame($expectedResult, ThaiTax::thaiYear(2560)->netIncome($netIncome)->incomeTax());
    }

    public function provideNetIncomeData(): array
    {
        return [
            [0, 0],
            [0, 150000],
            [0.05, 150001],
            [7500, 300000],
            [7500.1, 300001],
            [27500, 500000],
            [27500.15, 500001],
            [65000, 750000],
            [65000.2, 750001],
            [115000, 1000000],
            [115000.25, 1000001],
            [365000, 2000000],
            [365000.3, 2000001],
            [1265000, 5000000],
            [1265000.35, 5000001],
            [3015000, 10000000],
        ];
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2561(float $expectedResult, float $netIncome): void
    {
        $this->assertSame($expectedResult, ThaiTax::thaiYear(2561)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2562(float $expectedResult, float $netIncome): void
    {
        $this->assertSame($expectedResult, ThaiTax::thaiYear(2562)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2563(float $expectedResult, float $netIncome): void
    {
        $this->assertSame($expectedResult, ThaiTax::thaiYear(2563)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2564(float $expectedResult, float $netIncome): void
    {
        $this->assertSame($expectedResult, ThaiTax::thaiYear(2564)->netIncome($netIncome)->incomeTax());
    }
}
