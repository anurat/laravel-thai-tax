<?php

namespace Connectiv\ThaiTax;

use Connectiv\ThaiTax\Tables\TaxTable;
use Connectiv\ThaiTax\Traits\DeductionTrait;
use Connectiv\ThaiTax\Traits\IncomeTrait;
use Exception;

class TaxCalculation
{
    use IncomeTrait;
    use DeductionTrait;

    public const MAX_EXPENSES = 100000;

    private $thaiYear;
    private $netIncome;

    public function __construct()
    {
    }

    public function thaiYear(int $thaiYear): TaxCalculation
    {
        if ($thaiYear < TaxTable::START_YEAR) {
            throw new Exception('Unable to calculate tax before ' . TaxTable::START_YEAR);
        }

        $this->thaiYear = $thaiYear;

        return $this;
    }

    public function netIncome(float $netIncome): TaxCalculation
    {
        if ($netIncome < 0) {
            throw new Exception('Unable to calculate negative net income.');
        }

        $this->netIncome = $netIncome;

        return $this;
    }

    protected function calculateNetIncome(): void
    {
        $incomeSum = $this->incomeSum();

        $expenses = min(self::MAX_EXPENSES, $incomeSum * 50 / 100);

        $this->addPersonalDeduction();
        $deductionSum = $this->deductionSum();

        $this->netIncome = $incomeSum - $expenses - $deductionSum;
    }

    public function incomeTax(): float
    {
        if (!$this->emptyIncomesAndDeductions()) {
            $this->calculateNetIncome();
        }

        if (!$this->thaiYear || is_null($this->netIncome)) {
            throw new Exception('Thai year or net income are not specified.');
        }

        $table = TaxTable::tableFromYear($this->thaiYear);
        $netIncome = $this->netIncome;

        return $table->sum(function ($row) use ($netIncome) {
            if ($row['min'] > $netIncome) {
                return 0;
            }

            return $this->rowTax($netIncome, $row);
        });
    }

    public function emptyIncomesAndDeductions(): bool
    {
        $hasIncome = collect($this->incomes)
            ->contains(function ($income) {
                return count($income) > 0;
            });

        $hasDeduction = collect($this->deductions)
            ->contains(function ($deduction) {
                return count($deduction) > 0;
            });

        return !$hasIncome && !$hasDeduction;
    }

    protected function rowTax(float $netIncome, array $row): float
    {
        $minOfMax = $row['max'] === 'MAX' ? $netIncome : min($row['max'], $netIncome);

        return ($minOfMax - $row['min'] + 1) * $row['percentage'] / 100;
    }

    public function clearData(): TaxCalculation
    {
        foreach ($this->incomes as &$income) {
            $income = [];
        }

        foreach ($this->deductions as &$deduction) {
            $deduction = [];
        }

        $this->thaiYear = null;
        $this->netIncome = null;

        return $this;
    }

    public function import()
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \Connectiv\ThaiTax\Imports\TaxImport(), 'src/Tables/2560.csv');
    }
}
