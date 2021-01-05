<?php

namespace Connectiv\ThaiTax\Traits;

use Connectiv\ThaiTax\TaxCalculation;

trait DeductionTrait
{
    public static $PERSONAL_DEDUCTION = 60000;
    public static $MAX_HOME_LOAN_INTEREST = 100000;

    private $deductions = [
        'general' => [],
        'personal' => [],
        'homeLoanInterest' => [],
    ];

    public function deduction(float $deduction): TaxCalculation
    {
        $this->deductions['general'] = $deduction;

        $this->calculateNetIncome();

        return $this;
    }

    public function autoAddDeduction()
    {
        $this->deductions['personal'][] = $this->$PERSONAL_DEDUCTION;

        $this->calculateNetIncome();

        return $this;
    }

    public function homeLoanInterest(float $interest)
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
}
