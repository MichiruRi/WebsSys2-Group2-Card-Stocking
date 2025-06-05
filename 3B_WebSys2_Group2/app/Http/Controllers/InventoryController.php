<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inventory = Inventory::all();
        $inventory = Inventory::selectRaw('month, year')
            ->groupBy('month', 'year')
            ->get();
        $years = Inventory::selectRaw('year')
            ->groupBy('year')
            ->get();
        $months = Inventory::selectRaw('month')
            ->groupBy('month')
            ->get();
        $select_month = request()->input('select_month');
        $select_year = request()->input('select_year');
        $search = request()->input('search');
        if (!empty($select_year) || !empty($search) || !empty($select_month)) {
            $stockcard = Inventory::where('year', $select_year)->orWhere('item', $search)->orWhere('month', $select_month)->get();
        }
        return view('inventory.index', compact('inventory', 'years', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($month, $year)
    {
        //
        $inventory = Inventory::where('month', $month)->where('year', $year)->get();

        return view('inventory.show', compact('inventory', 'month', 'year'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($month, $year)
    {
        //
        $inventory = Inventory::where('month', $month)->where('year', $year)->get();

        return view('inventory.edit', compact('inventory', 'month', 'year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $inventory)
    {
        //
        $inventory = Inventory::find($inventory);
        $inventory->update([
            'purchased_supplies' => $request->purchased_supplies,
            'supplies_from_lingayen' => $request->supplies_from_lingayen,
            'purchased_total_cost' => $request->purchased_total_cost,
            'lingayen_total_cost' => $request->lingayen_total_cost,
            'issued' => $request->purchased_supplies,
            'inventory_end' => $request->inventory_end,
            'amount' => $request->amount,
        ]);
        return redirect()->route('inventory.edit', compact('month', 'year'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }


}
