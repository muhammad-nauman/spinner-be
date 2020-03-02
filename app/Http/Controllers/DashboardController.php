<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Machine;
use App\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $machinesCount = Machine::count();
        $inventoriesTotalToday = Inventory::where('for_day', now()->toDateString())->sum('quantity');
        $productsAvailableForToday = Product::wherehas('inventories', function($query){
            $query->where('for_day', now()->toDateString());
        })->count();
        return view('dashboard', compact('productsCount', 'machinesCount', 'inventoriesTotalToday', 'productsAvailableForToday'));
    }
}
