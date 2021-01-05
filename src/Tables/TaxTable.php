<?php

namespace Connectiv\ThaiTax\Tables;

use Illuminate\Support\Collection;

class TaxTable
{
    public const START_YEAR = 2556;
    public const TAX2556_TABLE = 'src/Tables/2556.csv';
    public const TAX2560_TABLE = 'src/Tables/2560.csv';

    public static function tableFromYear(int $thaiYear): Collection
    {
        $table = $thaiYear < 2560 ? self::TAX2556_TABLE : self::TAX2560_TABLE;
        $content = file_get_contents($table);

        return collect(explode("\r\n", $content))
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
}
