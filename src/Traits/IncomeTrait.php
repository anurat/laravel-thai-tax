<?php

namespace Connectiv\ThaiTax\Traits;

use Connectiv\ThaiTax\TaxCalculation;

trait IncomeTrait
{
    private $incomes = [
        'general' => [],
        'salary' => [],
        'bonus' => [],
    ];

    protected function incomeSum(): float
    {
        return collect($this->incomes)
            ->sum(function ($income) {
                return collect($income)->sum();
            });
    }

    public function income(float $income): TaxCalculation
    {
        $this->incomes['general'][] = $income;

        return $this;
    }

    public function salary(float $salaryPerMonth): TaxCalculation
    {
        $this->incomes['salary'][] = $salaryPerMonth * 12;

        return $this;
    }

    public function bonus(float $bonus): TaxCalculation
    {
        $this->incomes['bonus'][] = $bonus;

        return $this;
    }
}
