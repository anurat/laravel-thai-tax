<?php

namespace Connectiv\ThaiTax\Traits;

use Connectiv\ThaiTax\TaxCalculation;

trait DeductionTrait
{
    public static $PERSONAL_DEDUCTION = 60000;
    public static $SPOUSE_DEDUCTION = 60000;
    public static $CHILD_DEDUCTION = 30000;
    public static $PARENT_DEDUCTION = 30000;
    public static $MAX_NO_OF_PARENTS = 4;
    public static $MAX_INSURANCE_PREMIUM = 100000;
    public static $ANNUITY_INSURANCE_PREMIUM_RATE = 0.15;
    public static $MAX_ANNUITY_INSURANCE_PREMIUM = 200000;
    public static $MAX_HOME_LOAN_INTEREST = 100000;
    public static $PROVIDENT_FUND_RATE = 0.15;
    public static $MAX_PROVIDENCE_FUND = 500000;
    public static $MAX_SOCIAL_SECURITY = 9000;
    public static $DONATION_RATE = 0.1;

    private $deductions = [
        'general' => [],
        'personal' => [],
        'spouse' => [],
        'children' => [],
        'parents' => [],
        'insurancePremium' => [],
        'annuityInsurancePremium' => [],
        'homeLoanInterest' => [],
        'providentFund' => [],
        'socialSecurity' => [],
        'donations' => [],
        'educationDonations' => [],
    ];

    protected function deductionSum(): float
    {
        return collect($this->deductions)
            ->sum(function ($deduction) {
                return collect($deduction)->sum();
            });
    }

    public function deduction(float $deduction): TaxCalculation
    {
        $this->deductions['general'][] = $deduction;

        return $this;
    }

    public function spouse(bool $hasSpouse): TaxCalculation
    {
        if ($hasSpouse && sizeof($this->deductions['spouse']) === 0) {
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

    protected function addPersonalDeduction(): void
    {
        if (sizeof($this->deductions['personal']) === 0) {
            $this->deductions['personal'][] = self::$PERSONAL_DEDUCTION;
        }
    }
}
