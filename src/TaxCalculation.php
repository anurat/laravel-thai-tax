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

    public const THAI_YEAR_DIFFERENCE = 543;

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
            $this->thaiYear = date('Y') + self::THAI_YEAR_DIFFERENCE;
        }

        if ($this->hasIncome() || $this->hasDeduction()) {
            $this->calculateNetIncome();
        }

        if (is_null($this->netIncome)) {
            throw new Exception('Net income are not specified.');
        }

        $tax = TaxTable::calculateTax($this->thaiYear, $this->netIncome);

        $this->clearData();

        return $tax;
    }

    protected function clearData(): TaxCalculation
    {
        $this->clearIncome();
        $this->clearDeduction();

        $this->thaiYear = null;
        $this->netIncome = null;

        return $this;
    }
}
