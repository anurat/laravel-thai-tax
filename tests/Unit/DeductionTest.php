<?php

namespace Connectiv\ThaiTax\Tests\Unit;

use Connectiv\ThaiTax\Facades\ThaiTax;
use Connectiv\ThaiTax\Tests\TestCase;

class DeductionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testAddDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->deduction(100000);

        $this->assertEquals(4500, $thaiTax->incomeTax());
    }

    public function testAddMultipleDeductions()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(1000000)
            ->deduction(100000)
            ->deduction(200000)
            ->deduction(300000);

        $this->assertEquals(4500, $thaiTax->incomeTax());
    }

    public function testAddDifferentTypesOfDeductions()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(1000000)
            ->spouse(true)
            ->children(2)
            ->parents(3)
            ->insurancePremium(50000);

        $this->assertEquals(39500, $thaiTax->incomeTax());
    }

    public function testNoDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(320000);

        $this->assertEquals(500, $thaiTax->incomeTax());
    }

    public function testSpouseDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(380000)
            ->spouse(true);

        $this->assertEquals(500, $thaiTax->incomeTax());
    }

    public function testCallingSpouseDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(380000)
            ->spouse(true)
            ->spouse(true);

        $this->assertEquals(500, $thaiTax->incomeTax());
    }

    public function testChildrenDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(380000)
            ->children(2);

        $this->assertEquals(500, $thaiTax->incomeTax());
    }

    public function testCallingChildrenDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(440000)
            ->children(2)
            ->children(2);

        $this->assertEquals(500, $thaiTax->incomeTax());
    }

    public function testParentsDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(380000)
            ->parents(2);

        $this->assertEquals(500, $thaiTax->incomeTax());
    }

    public function testCallingParentsDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(410000)
            ->parents(1)
            ->parents(2);

        $this->assertEquals(500, $thaiTax->incomeTax());
    }

    public function testInsurancePremiumDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->insurancePremium(50000);

        $this->assertEquals(7000, $thaiTax->incomeTax());
    }

    public function testMaxInsurancePremiumDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->insurancePremium(120000);

        $this->assertEquals(4500, $thaiTax->incomeTax());
    }

    public function testCallingInsurancePremiumDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->insurancePremium(50000)
            ->insurancePremium(50000);

        $this->assertEquals(4500, $thaiTax->incomeTax());
    }

    public function testAnnuityInsurancePremiumDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->annuityInsurancePremium(50000);

        $this->assertEquals(7000, $thaiTax->incomeTax());
    }

    public function testMaxAnnuityInsurancePremiumRateDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->annuityInsurancePremium(100000);

        $this->assertEquals(5750, $thaiTax->incomeTax());
    }

    public function testMaxAnnuityInsurancePremiumDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(1500000)
            ->annuityInsurancePremium(250000);

        $this->assertEquals(150000, $thaiTax->incomeTax());
    }

    public function testHomeLoanInterestDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->homeLoanInterest(50000);

        $this->assertEquals(7000, $thaiTax->incomeTax());
    }

    public function testMaxHomeLoanInterestDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->homeLoanInterest(150000);

        $this->assertEquals(4500, $thaiTax->incomeTax());
    }
}
