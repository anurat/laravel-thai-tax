<?php

namespace Anurat\ThaiTax\Traits;

use Anurat\ThaiTax\TaxCalculation;

trait DeductionTrait
{
    public static $PERSONAL_DEDUCTION = 60000;
    public static $SPOUSE_DEDUCTION = 60000;
    public static $CHILD_DEDUCTION = 30000;
    public static $PARENT_DEDUCTION = 30000;
    public static $DISABILITY_DEDUCTION = 60000;
    public static $MAX_CHILD_BIRTH = 60000;
    public static $MAX_NO_OF_PARENTS = 4;
    public static $MAX_INSURANCE_PREMIUM = 100000;
    public static $ANNUITY_INSURANCE_PREMIUM_RATE = 0.15;
    public static $MAX_ANNUITY_INSURANCE_PREMIUM = 200000;
    public static $MAX_HOME_LOAN_INTEREST = 100000;
    public static $PROVIDENT_FUND_RATE = 0.15;
    public static $MAX_PROVIDENCE_FUND = 500000;
    public static $MAX_SOCIAL_SECURITY = 9000;
    public static $DONATION_RATE = 0.1;
    public static $EDUCATION_DONATION_DEDUCTION_RATE = 2;
    public static $MAX_POLITICAL_PARTY = 10000;
    public static $MAX_SHOP_DEE_MEE_KUEN = 30000;
    public static $SHOP_DEE_MEE_KUEN_YEAR = 2564;

    private $deductions = [
        'general' => [],
        'personal' => [],
        'spouse' => [],
        'children' => [],
        'parents' => [],
        'disabilities' => [],
        'childBirth' => [],
        'insurancePremium' => [],
        'annuityInsurancePremium' => [],
        'homeLoanInterest' => [],
        'providentFund' => [],
        'socialSecurity' => [],
        'donation' => [],
        'educationDonation' => [],
        'politicalParty' => [],
        'shopDeeMeeKeun' => [],
    ];

    protected function deductionSum(): float
    {
        return collect($this->deductions)
            ->flatten()
            ->sum();
    }

    protected function hasDeduction(): bool
    {
        return collect($this->deductions)
            ->contains(function ($deduction) {
                return count($deduction) > 0;
            });
    }

    protected function clearDeduction(): void
    {
        foreach ($this->deductions as &$deduction) {
            $deduction = [];
        }
    }

    public function deduction(float $deduction): TaxCalculation
    {
        $this->deductions['general'][] = $deduction;

        return $this;
    }

    public function spouse(bool $hasSpouse): TaxCalculation
    {
        if ($hasSpouse && count($this->deductions['spouse']) === 0) {
            $this->deductions['spouse'][] = self::$SPOUSE_DEDUCTION;
        }

        return $this;
    }

    public function children(int $noOfChildren): TaxCalculation
    {
        $this->deductions['children'][] = $noOfChildren * self::$CHILD_DEDUCTION;

        return $this;
    }

    public function parents(int $noOfParents): TaxCalculation
    {
        $parentsSum = collect($this->deductions['parents'])->sum();

        $this->deductions['parents'][] = min($noOfParents, self::$MAX_NO_OF_PARENTS) * self::$PARENT_DEDUCTION;

        return $this;
    }

    public function disabilities(int $noOfDisabilities): TaxCalculation
    {
        $this->deductions['children'][] = $noOfDisabilities * self::$DISABILITY_DEDUCTION;

        return $this;
    }

    public function childBirth(float $cost): TaxCalculation
    {

        $this->deductions['childBirth'][] = min(self::$MAX_CHILD_BIRTH, $cost);

        return $this;
    }

    public function insurancePremium(float $premium): TaxCalculation
    {
        $sum = collect($this->deductions['insurancePremium'])->sum();

        if ($sum >= self::$MAX_INSURANCE_PREMIUM) {
            return $this;
        }

        $this->deductions['insurancePremium'][] = (
            $sum + $premium >= self::$MAX_INSURANCE_PREMIUM ?
            self::$MAX_INSURANCE_PREMIUM - $sum :
            $premium);

        return $this;
    }

    public function annuityInsurancePremium(float $premium): TaxCalculation
    {
        $premiumSum = collect($this->deductions['annuityInsurancePremium'])->sum();
        $incomeSum = $this->incomeSum();
        $minSum = min(self::$MAX_ANNUITY_INSURANCE_PREMIUM, $incomeSum * self::$ANNUITY_INSURANCE_PREMIUM_RATE);

        if ($premiumSum >= $minSum) {
            return $this;
        }

        $this->deductions['annuityInsurancePremium'][] = (
            $premiumSum + $premium >= $minSum ?
            $minSum - $premiumSum :
            $premium);

        return $this;
    }

    public function homeLoanInterest(float $interest): TaxCalculation
    {
        $sum = collect($this->deductions['homeLoanInterest'])->sum();

        if ($sum >= self::$MAX_HOME_LOAN_INTEREST) {
            return $this;
        }

        $this->deductions['homeLoanInterest'][] = (
            $sum + $interest >= self::$MAX_HOME_LOAN_INTEREST ?
            self::$MAX_HOME_LOAN_INTEREST - $sum :
            $interest);

        return $this;
    }

    public function providentFund(float $fund): TaxCalculation
    {
        if (
            $fund <= $this->incomeSum() * self::$PROVIDENT_FUND_RATE &&
            $fund <= self::$MAX_PROVIDENCE_FUND
        ) {
            $this->deductions['providentFund'][] = $fund;
        } else {
            $this->deductions['providentFund'][] = min(
                $this->incomeSum() * self::$PROVIDENT_FUND_RATE,
                self::$MAX_PROVIDENCE_FUND
            );
        }

        return $this;
    }

    public function socialSecurity(float $security): TaxCalculation
    {
        if (count($this->deductions['socialSecurity']) > 0) {
            return $this;
        }

        $this->deductions['socialSecurity'][] = (
            $security <= self::$MAX_SOCIAL_SECURITY ?
            $security :
            self::$MAX_SOCIAL_SECURITY);

        return $this;
    }

    public function donation(float $donation): TaxCalculation
    {
        $this->calculateNetIncome();

        $maxDonation = $this->netIncome * self::$DONATION_RATE;
        $donationSum = $this->donationSum();
        if ($donationSum >= $maxDonation) {
            return $this;
        }

        $this->deductions['donation'][] = (
            $donationSum + $donation >= $maxDonation ?
            $maxDonation - $donationSum :
            $donation);

        return $this;
    }

    protected function donationSum(): float
    {
        return (collect($this->deductions['donation'])->sum() +
            collect($this->deductions['educationDonation'])->sum());
    }

    public function educationDonation(float $donation): TaxCalculation
    {
        $this->calculateNetIncome();

        $maxDonation = $this->netIncome * self::$DONATION_RATE;
        $donationSum = $this->donationSum();
        if ($donationSum >= $maxDonation) {
            return $this;
        }

        $this->deductions['educationdonation'][] = (
            $donationSum + ($donation * self::$EDUCATION_DONATION_DEDUCTION_RATE) >= $maxDonation ?
            $maxDonation - $donationSum :
            $donation * self::$EDUCATION_DONATION_DEDUCTION_RATE);

        return $this;
    }

    public function politicalParty(float $donation): TaxCalculation
    {
        $sum = collect($this->deductions['politicalParty'])->sum();
        if ($sum >= self::$MAX_PROVIDENCE_FUND) {
            return $this;
        }

        $this->deductions['politicalParty'][] = (
            $sum + $donation >= self::$MAX_POLITICAL_PARTY ?
            self::$MAX_POLITICAL_PARTY - $sum :
            $donation);

        return $this;
    }

    public function shopDeeMeeKeun(float $shop): TaxCalculation
    {
        $sum = collect($this->deductions['shopDeeMeeKeun'])->sum();

        if (
            $sum >= self::$MAX_SHOP_DEE_MEE_KUEN ||
            $this->thaiYear !== self::$SHOP_DEE_MEE_KUEN_YEAR
        ) {
            return $this;
        }

        $this->deductions['shopDeeMeeKeun'][] = (
            $sum + $shop >= self::$MAX_SHOP_DEE_MEE_KUEN ?
            self::$MAX_SHOP_DEE_MEE_KUEN - $sum :
            $shop);

        return $this;
    }

    protected function addPersonalDeduction(): void
    {
        if (count($this->deductions['personal']) === 0) {
            $this->deductions['personal'][] = self::$PERSONAL_DEDUCTION;
        }
    }
}
