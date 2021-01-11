<?php

namespace Anurat\ThaiTax\Traits;

trait ExpenseTrait
{
    public static $MAX_EXPENSES = 100000;
    public static $INCOME_PERCENTAGE = 50;

    protected function expenses(float $incomeSum): float
    {
        return min(self::$MAX_EXPENSES, $incomeSum * self::$INCOME_PERCENTAGE / 100);
    }
}
