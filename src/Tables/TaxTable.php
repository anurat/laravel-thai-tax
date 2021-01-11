<?php

namespace Anurat\ThaiTax\Tables;

use Illuminate\Support\Collection;

class TaxTable
{
    public const START_YEAR = 2542;
    public const TAX2542_TABLE = '2542.php';
    public const TAX2552_TABLE = '2552.php';
    public const TAX2560_TABLE = '2560.php';

    public static function calculateTax(int $thaiYear, float $netIncome): float
    {
        $table = self::tableFromYear($thaiYear);

        return $table->sum(function ($row) use ($netIncome) {
            if ($row['min'] > $netIncome) {
                return 0;
            }

            return self::taxInOneRow($netIncome, $row);
        });
    }

    protected static function tableFromYear(int $thaiYear): Collection
    {
        $tableFilename = self::getTableFilename($thaiYear);
        $table = include __DIR__ . '/' . $tableFilename;

        return collect($table);
    }

    protected static function getTableFilename(int $thaiYear): string
    {
        if ($thaiYear < 2552) {
            return self::TAX2542_TABLE;
        }

        if ($thaiYear < 2560) {
            return self::TAX2552_TABLE;
        }

        return self::TAX2560_TABLE;
    }

    protected static function taxInOneRow(float $netIncome, array $row): float
    {
        $minOfMax = $row['max'] === 'MAX' ? $netIncome : min($row['max'], $netIncome);

        return ($minOfMax - $row['min'] + 1) * $row['percentage'] / 100;
    }
}
