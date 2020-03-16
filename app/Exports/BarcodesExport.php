<?php

namespace App\Exports;

use App\Barcode;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarcodesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barcode::select('barcode')->getq();
    }
}
