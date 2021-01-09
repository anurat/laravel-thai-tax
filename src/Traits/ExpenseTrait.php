<?php

namespace Connectiv\ThaiTax\Traits;

trait ExpenseTrait
{
    public static $MAX_EXPENSES = 100000;

    protected function expenses(float $incomeSum): float
    {
        return min(self::$MAX_EXPENSES, $incomeSum * 50 / 100);
    }
}
