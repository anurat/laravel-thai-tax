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

    public function income(float $income): TaxCalculation
    {
        $this->incomes['general'][] = $income;

        $this->calculateNetIncome();

        return $this;
    }

    public function salary(float $salary): TaxCalculation
    {
        $this->incomes['salary'][] = $salary;

        $this->calculateNetIncome();

        return $this;
    }

    public function bonus(float $bonus): TaxCalculation
    {
        $this->incomes['bonus'][] = $bonus;

        $this->calculateNetIncome();

        return $this;
    }
}
