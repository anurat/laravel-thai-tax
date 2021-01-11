<?php

namespace Anurat\ThaiTax\Traits;

use Anurat\ThaiTax\TaxCalculation;

trait DeductionTrait
{
    protected static $PERSONAL_DEDUCTION = 60000;
    protected static $SPOUSE_DEDUCTION = 60000;
    protected static $CHILD_DEDUCTION = 30000;
    protected static $PARENT_DEDUCTION = 30000;
    protected static $DISABILITY_DEDUCTION = 60000;
    protected static $MAX_CHILD_BIRTH = 60000;
    protected static $MAX_NO_OF_PARENTS = 4;
    protected static $MAX_INSURANCE_PREMIUM = 100000;
    protected static $ANNUITY_INSURANCE_PREMIUM_RATE = 0.15;
    protected static $MAX_ANNUITY_INSURANCE_PREMIUM = 200000;
    protected static $MAX_HOME_LOAN_INTEREST = 100000;
    protected static $PROVIDENT_FUND_RATE = 0.15;
    protected static $MAX_PROVIDENCE_FUND = 500000;
    protected static $MAX_SOCIAL_SECURITY = 9000;
    protected static $DONATION_RATE = 0.1;
    protected static $EDUCATION_DONATION_DEDUCTION_RATE = 2;
    protected static $MAX_POLITICAL_PARTY = 10000;
    protected static $MAX_SHOP_DEE_MEE_KUEN = 30000;
    protected static $SHOP_DEE_MEE_KUEN_YEAR = 2564;

    protected $deductions = [
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

    /**
     * @param  array|float  $deduction
     */
    public function deduction($deduction): TaxCalculation
    {
        if (is_array($deduction)) {
            $this->addDeductions($deduction);

            return $this;
        }

        if (is_numeric($deduction)) {
            $this->deductions['general'][] = (float) $deduction;

            return $this;
        }

        throw new Exception('Deduction is neither an array nor number.');
    }

    protected function addDeductions(array $deductions): void
    {
        foreach ($deductions as $type => $deduction) {
            if (array_key_exists($type, $this->deductions)) {
                $this->$type($deduction);
                continue;
            }

            $this->deductions['general'][] = $deduction;
        }
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
