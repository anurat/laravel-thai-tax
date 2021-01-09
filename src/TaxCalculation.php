<?php

namespace Anurat\ThaiTax;

use Anurat\ThaiTax\Tables\TaxTable;
use Anurat\ThaiTax\Traits\DeductionTrait;
use Anurat\ThaiTax\Traits\ExpenseTrait;
use Anurat\ThaiTax\Traits\IncomeTrait;
use Exception;

class TaxCalculation
{
    use IncomeTrait;
    use DeductionTrait;
    use ExpenseTrait;

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
        $this->addPersonalDeduction();
        $incomeSum = $this->incomeSum();

        $this->netIncome = $incomeSum - $this->expenses($incomeSum) - $this->deductionSum();
    }

    public function incomeTax(): float
    {
        if (!$this->thaiYear) {
            $this->thaiYear = date('Y') + 543;
        }

        if ($this->hasIncome() || $this->hasDeduction()) {
            $this->calculateNetIncome();
        }

        if (is_null($this->netIncome)) {
            throw new Exception('Net income are not specified.');
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

    protected function rowTax(float $netIncome, array $row): float
    {
        $minOfMax = $row['max'] === 'MAX' ? $netIncome : min($row['max'], $netIncome);

        return ($minOfMax - $row['min'] + 1) * $row['percentage'] / 100;
    }

    public function clearData(): TaxCalculation
    {
        $this->clearIncome();
        $this->clearDeduction();

        $this->thaiYear = null;
        $this->netIncome = null;

        return $this;
    }
}
