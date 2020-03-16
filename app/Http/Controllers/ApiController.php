<?php

namespace App\Http\Controllers;

use App\Machine;
use App\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function machines()
    {
        $machines = Machine::get();

        return response()->json([
            'success' => true,
            'data' => $machines
        ]);
    }

    public function products(Machine $machine)
    {
        $products = Product::with('inventories')->withCount('inventories')->get();


        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}
