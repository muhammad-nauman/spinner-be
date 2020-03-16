<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Barcode;

class BarcodeExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
//        return Barcode::pluck('barcode');
    }
}
