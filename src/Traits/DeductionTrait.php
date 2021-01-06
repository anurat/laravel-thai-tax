<?php

namespace Connectiv\ThaiTax\Traits;

use Connectiv\ThaiTax\TaxCalculation;

trait DeductionTrait
{
    public static $PERSONAL_DEDUCTION = 60000;
    public static $SPOUSE_DEDUCTION = 60000;
    public static $CHILD_DEDUCITON = 30000;
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

    public function deduction(float $deduction): TaxCalculation
    {
        $this->deductions['general'] = $deduction;

        $this->calculateNetIncome();

        return $this;
    }

    public function spouse(bool $hasSpouse): TaxCalculation
    {
        if ($hasSpouse && sizeof($this->deductions['spouse']) === 0) {
            $this->deductions['spouse'][] = $this->SPOUSE_DEDUCTION;
        }

        $this->calculateNetIncome();

        return $this;
    }

    public function children(int $noOfChildren): TaxCalculation
    {
        $this->deductions['children'][] = $noOfChildren * $this->CHILD_DEDUCTION;

        $this->calculateNetIncome();

        return $this;
    }

    public function parents(int $noOfParents): TaxCalculation
    {
        if (sizeof($this->deductions['parents']) === 0) {
            $this->deductions['parents'][] = min($noOfParents, $this->MAX_NO_OF_PARENTS) * $this->PARENT_DEDUCTION;
        }

        $this->calculateNetIncome();

        return $this;
    }

    public function homeLoanInterest(float $interest): TaxCalculation
    {
        $sum = collect($this->deductions['homeLoanInterest'])->sum();

        if ($sum >= $this->MAX_HOME_LOAN_INTEREST) {
            return $this;
        }

        $this->deductions['homeLoanInterest'][] = (
            $sum + $interest >= $this->MAX_HOME_LOAN_INTEREST ?
            $this->MAX_HOME_LOAN_INTEREST - $sum :
            $interest);

        $this->calculateNetIncome();

        return $this;
    }

    public function insurancePremium(float $premium): TaxCalculation
    {
        $sum = collect($this->deductions['insurancePremium'])->sum();

        if ($sum >= $this->MAX_INSURANCE_PREMIUM) {
            return $this;
        }

        $this->deductions['insurancePremium'][] = (
            $sum + $premium >= $this->MAX_INSURANCE_PREMIUM ?
            $this->MAX_INSURANCE_PREMIUM - $sum :
            $premium);

        $this->calculateNetIncome();

        return $this;
    }

}
