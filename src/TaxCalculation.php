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
        $this->deductions['personal'][] = $this->PERSONAL_DEDUCTION;
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

    protected function calculateNetIncome()
    {
        $incomes = collect($this->incomes)->reduce(function ($sum, $income) {
            return $sum + collect($income)->sum();
        }, 0);

        $expenses = min(self::MAX_EXPENSES, $incomes * 50 / 100);

        $deductions = collect($this->deductions)->reduce(function ($sum, $deduction) {
            return $sum + collect($deduction)->sum();
        }, 0);

        $this->netIncome = $incomes - $expenses - $deductions;
    }

    public function incomeTax(): float
    {
        if (!$this->thaiYear || is_null($this->netIncome)) {
            throw new Exception('Thai year or net income are not specified.');
        }

        $table = TaxTable::tableFromYear($this->thaiYear);
        $netIncome = $this->netIncome;

        $tax = $table->reduce(function ($sum, $row) use ($netIncome) {
            if ($row['min'] > $netIncome) {
                return $sum;
            }

            return $sum + $this->rowTax($netIncome, $row);
        }, 0);

        return $tax;
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

    protected function rowTax(float $netIncome, array $row): float
    {
        $minOfMax = $row['max'] === 'MAX' ? $netIncome : min($row['max'], $netIncome);

        return ($minOfMax - $row['min'] + 1) * $row['percentage'] / 100;
    }

    public function import()
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \Connectiv\ThaiTax\Imports\TaxImport(), 'src/Tables/2560.csv');
    }
}
