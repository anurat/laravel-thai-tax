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

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2552(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2552)->netIncome($netIncome)->incomeTax());
    }

    public function provideNetIncomeData(): array
    {
        return [
            [0, 0],
            [0, 150000],
            [0.1, 150001],
            [35000, 500000],
            [35000.2, 500001],
            [135000, 1000000],
            [135000.3, 1000001],
            [1035000, 4000000],
            [1035000.37, 4000001],
            [1405000, 5000000],
        ];
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2553(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2553)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2554(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2554)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2555(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2555)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2556(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2556)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2557(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2557)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2558(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2558)->netIncome($netIncome)->incomeTax());
    }

    /**
     * @dataProvider provideNetIncomeData
     */
    public function testYear2559(float $expectedResult, float $netIncome): void
    {
        $this->assertEquals($expectedResult, ThaiTax::thaiYear(2559)->netIncome($netIncome)->incomeTax());
    }
}
