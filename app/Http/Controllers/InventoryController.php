<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Machine;
use App\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $machines = Machine::get();
        $inventories = $product->inventories()->with('machine')->get();

        return view('inventories.index', compact('inventories', 'product', 'machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->validate($request,[
            'for_day' => 'required|date',
            'quantity' => 'required|min:0|max:500',
            'machine_id' => 'required|exists:machines,id'
        ]);

        $product->inventories()->save(new Inventory($request->only('for_day', 'quantity', 'machine_id')));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Inventory $inventory)
    {
        return view('inventories.edit', compact('product', 'inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Inventory $inventory)
    {
        $this->validate($request, [
            'for_day' => 'required|date',
            'quantity' => 'required|min:0|max:200'
        ]);

        $inventory->update($request->only('for_day', 'quantity'));

        return redirect()->route('products.inventories.index', [
            'product' => $product->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->back();
    }
}
