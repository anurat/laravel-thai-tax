<?php

namespace Anurat\ThaiTax\Tables;

use Illuminate\Support\Collection;

class TaxTable
{
    public const START_YEAR = 2542;
    public const TAX2542_TABLE = '/2542.csv';
    public const TAX2552_TABLE = '/2552.csv';
    public const TAX2560_TABLE = '/2560.csv';

    public static function tableFromYear(int $thaiYear): Collection
    {
        $tableFilename = self::getTableFilename($thaiYear);
        $table = file_get_contents(__DIR__ . $tableFilename);

        return collect(explode("\r\n", $table))
            ->map(function ($row) {
                $r = explode(",", $row);

                return [
                    'min' => $r[0],
                    'max' => $r[1],
                    'percentage' => $r[2],
                ];
            })
            ->slice(1);
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
}
