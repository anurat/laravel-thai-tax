<?php

namespace Connectiv\ThaiTax\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TaxImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            TaxRate::create([
                'min' => $row[0],
                'max' => $row[1],
                'percentage' => $row[2],
            ]);
        }
    }
}
