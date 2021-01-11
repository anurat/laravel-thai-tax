<?php

namespace Anurat\ThaiTax\Traits;

use Anurat\ThaiTax\TaxCalculation;

trait IncomeTrait
{
    protected static $NO_OF_MONTHS = 12;

    private $incomes = [
        'general' => [],
        'salary' => [],
        'bonus' => [],
    ];

    protected function incomeSum(): float
    {
        return collect($this->incomes)
            ->flatten()
            ->sum();
    }

    protected function hasIncome(): bool
    {
        return collect($this->incomes)
            ->contains(function ($income) {
                return count($income) > 0;
            });
    }

    protected function clearIncome(): void
    {
        foreach ($this->incomes as &$income) {
            $income = [];
        }
    }

    public function income(float $income): TaxCalculation
    {
        $this->incomes['general'][] = $income;

        return $this;
    }

    public function salary(float $salaryPerMonth): TaxCalculation
    {
        $this->incomes['salary'][] = $salaryPerMonth * self::$NO_OF_MONTHS;

        return $this;
    }

    public function bonus(float $bonus): TaxCalculation
    {
        $this->incomes['bonus'][] = $bonus;

        return $this;
    }
}
