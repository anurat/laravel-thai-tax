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

    /**
     * @param  float|array  $income
     */
    public function income($income): TaxCalculation
    {
        if (is_array($income)) {
            $this->addIncomes($income);

            return $this;
        }

        if (is_numeric($income)) {
            $this->incomes['general'][] = (float) $income;

            return $this;
        }

        throw new Exception('Income is neither an array nor number.');
    }

    protected function addIncomes(array $incomes): void
    {
        foreach ($incomes as $type => $income) {
            if (array_key_exists($type, $this->incomes)) {
                $this->$type($income);
                continue;
            }

            $this->incomes['general'][] = $income;
        }
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
