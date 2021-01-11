<?php

namespace Anurat\ThaiTax\Tests\Unit;

use Anurat\ThaiTax\Facades\ThaiTax;
use Anurat\ThaiTax\Tests\TestCase;

class DeductionTest extends TestCase
{
    public function testAddDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->deduction(100000);

        $this->assertSame(4500.0, $thaiTax->incomeTax());
    }

    public function testAddMultipleDeductions()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(1000000)
            ->deduction(100000)
            ->deduction(200000)
            ->deduction(300000);

        $this->assertSame(4500.0, $thaiTax->incomeTax());
    }

    public function testAddDifferentTypesOfDeductions()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(1000000)
            ->spouse(true)
            ->children(2)
            ->parents(3)
            ->insurancePremium(50000);

        $this->assertSame(39500.0, $thaiTax->incomeTax());
    }

    public function testNoDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(320000);

        $this->assertSame(500.0, $thaiTax->incomeTax());
    }

    public function testSpouseDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(380000)
            ->spouse(true);

        $this->assertSame(500.0, $thaiTax->incomeTax());
    }

    public function testCallingSpouseDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(380000)
            ->spouse(true)
            ->spouse(true);

        $this->assertSame(500.0, $thaiTax->incomeTax());
    }

    public function testChildrenDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(380000)
            ->children(2);

        $this->assertSame(500.0, $thaiTax->incomeTax());
    }

    public function testCallingChildrenDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(440000)
            ->children(2)
            ->children(2);

        $this->assertSame(500.0, $thaiTax->incomeTax());
    }

    public function testParentsDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(380000)
            ->parents(2);

        $this->assertSame(500.0, $thaiTax->incomeTax());
    }

    public function testCallingParentsDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(410000)
            ->parents(1)
            ->parents(2);

        $this->assertSame(500.0, $thaiTax->incomeTax());
    }

    public function testDisabilitiesDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->disabilities(2);

        $this->assertSame(3500.0, $thaiTax->incomeTax());
    }

    public function testCallingDisabilitiesDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->disabilities(1)
            ->disabilities(2);

        $this->assertSame(500.0, $thaiTax->incomeTax());
    }

    public function testChildBirthDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->childBirth(50000);

        $this->assertSame(7000.0, $thaiTax->incomeTax());
    }

    public function testMaxChildBirthDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->childBirth(60000);

        $this->assertSame(6500.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->childBirth(100000);

        $this->assertSame(6500.0, $thaiTax->incomeTax());
    }

    public function testCallingChildBirthDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->childBirth(50000)
            ->childBirth(50000);

        $this->assertSame(4500.0, $thaiTax->incomeTax());
    }

    public function testInsurancePremiumDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->insurancePremium(50000);

        $this->assertSame(7000.0, $thaiTax->incomeTax());
    }

    public function testMaxInsurancePremiumDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->insurancePremium(100000);

        $this->assertSame(4500.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->insurancePremium(120000);

        $this->assertSame(4500.0, $thaiTax->incomeTax());
    }

    public function testCallingInsurancePremiumDeductionTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->insurancePremium(50000)
            ->insurancePremium(50000);

        $this->assertSame(4500.0, $thaiTax->incomeTax());
    }

    public function testAnnuityInsurancePremiumDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->annuityInsurancePremium(50000);

        $this->assertSame(7000.0, $thaiTax->incomeTax());
    }

    public function testMaxAnnuityInsurancePremiumRateDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->annuityInsurancePremium(75000);

        $this->assertSame(5750.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->annuityInsurancePremium(100000);

        $this->assertSame(5750.0, $thaiTax->incomeTax());
    }

    public function testMaxAnnuityInsurancePremiumDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(1500000)
            ->annuityInsurancePremium(200000);

        $this->assertSame(150000.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(1500000)
            ->annuityInsurancePremium(250000);

        $this->assertSame(150000.0, $thaiTax->incomeTax());
    }

    public function testHomeLoanInterestDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->homeLoanInterest(50000);

        $this->assertSame(7000.0, $thaiTax->incomeTax());
    }

    public function testMaxHomeLoanInterestDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->homeLoanInterest(100000);

        $this->assertSame(4500.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->homeLoanInterest(150000);

        $this->assertSame(4500.0, $thaiTax->incomeTax());
    }

    public function testProvidentFundDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->providentFund(50000);

        $this->assertSame(7000.0, $thaiTax->incomeTax());
    }

    public function testMaxProvidentFundRateDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->providentFund(150000);

        $this->assertSame(5750.0, $thaiTax->incomeTax());
    }

    public function testMaxProvidentFundDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(10000000)
            ->providentFund(500000);

        $this->assertSame(2784000.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(10000000)
            ->providentFund(600000);

        $this->assertSame(2784000.0, $thaiTax->incomeTax());
    }

    public function testSocialSecurityDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->socialSecurity(5000);

        $this->assertSame(11000.0, $thaiTax->incomeTax());
    }

    public function testMaxSocialSecurityDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->socialSecurity(9000);

        $this->assertSame(10600.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->socialSecurity(10000);

        $this->assertSame(10600.0, $thaiTax->incomeTax());
    }

    public function testDonationDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->donation(30000);

        $this->assertSame(8500.0, $thaiTax->incomeTax());
    }

    public function testMaxDonationDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->donation(34000);

        $this->assertSame(8100.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->donation(50000);

        $this->assertSame(8100.0, $thaiTax->incomeTax());
    }

    public function testEducationDonationDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->educationDonation(10000);

        $this->assertSame(9500.0, $thaiTax->incomeTax());
    }

    public function testMaxEducationDonationDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->educationDonation(17000);

        $this->assertSame(8100.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->educationDonation(20000);

        $this->assertSame(8100.0, $thaiTax->incomeTax());
    }

    public function testPoliticalPartyDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->politicalParty(5000);

        $this->assertSame(11000.0, $thaiTax->incomeTax());
    }

    public function testMaxPoliticalPartyDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->politicalParty(10000);

        $this->assertSame(10500.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->politicalParty(20000);

        $this->assertSame(10500.0, $thaiTax->incomeTax());
    }

    public function testShopDeeMeeKeunDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->shopDeeMeeKeun(20000);

        $this->assertSame(9500.0, $thaiTax->incomeTax());
    }

    public function testMaxShopDeeMeeKeunDeduction()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->shopDeeMeeKeun(30000);

        $this->assertSame(8500.0, $thaiTax->incomeTax());

        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->shopDeeMeeKeun(40000);

        $this->assertSame(8500.0, $thaiTax->incomeTax());
    }

    public function testCallingShopDeeMeeKeunTwice()
    {
        $thaiTax = ThaiTax::thaiYear(2564)
            ->income(500000)
            ->shopDeeMeeKeun(10000)
            ->shopDeeMeeKeun(10000);

        $this->assertSame(9500.0, $thaiTax->incomeTax());
    }
}
