<?php

namespace App\Http\Controllers;

use App\Exports\BarcodesExport;
use Illuminate\Http\Request;
use Excel;

class BarcodeController extends Controller
{
    public function index()
    {
        return Excel::download(new BarcodesExport, 'barcodes.csv');
    }
}
