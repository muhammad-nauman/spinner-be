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
        $products = Product::whereHas('inventories', function($query) use ($machine) {
            $query->where('machine_id', $machine->id)->where('for_day', now()->toDateString());
        })->withCount('inventories')->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }
}
