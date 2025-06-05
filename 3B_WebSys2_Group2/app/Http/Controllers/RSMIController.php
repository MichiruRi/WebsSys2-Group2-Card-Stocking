<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\RSMI;
use App\Models\StockCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class RSMIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $table = RSMI::all();
        $rsmi = RSMI::selectRaw('month, year')
            ->groupBy('month', 'year')
            ->get();
        $month = now()->format('F');
        $year = now()->format('Y');
        $years = RSMI::selectRaw('year')
            ->groupBy('year')
            ->get();
        $months = RSMI::selectRaw('month')
            ->groupBy('month')
            ->get();
        $select_month = request()->input('select_month');
        $select_year = request()->input('select_year');
        $search = request()->input('search');
        if (!empty($select_year) || !empty($search) || !empty($select_month)) {
            $stockcard = RSMI::where('year', $select_year)->orWhere('item', $search)->orWhere('month', $select_month)->get();
        }
        return view('RSMI.index', compact('rsmi', 'month', 'year', 'months', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($month, $year)
    {
        //
        $rsmi = RSMI::where('month', $month)->where('year', $year)->get();
        $month = now()->format('F');
        $year = now()->format('Y');
        $grandTotal = RSMI::sum('amount');

        $grouped = $rsmi->groupBy('item');
        $result = $grouped->map(function ($group) {
            return [
                'item' => $group->first()->item,
                'total_quantity' => $group->sum('quantity_issued'),
                'total_unit_cost' => $group->first()->unit_cost * $group->first()->quantity_issued,
                'stock_no' => $group->first()->stock_no,
                'unit' => $group->first()->unit,
                'unit_cost' => $group->first()->unit_cost,
                'records' => $group,
            ];
        });

        return view('rsmi.show', compact('rsmi', 'grandTotal', 'result', 'month', 'year'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'date' => '',
            'month' => '',
            'year' => '',
            'fund_cluster' => '',
            'RIS_No' => '',
            'office' => '',
            'center_code' => '',
            'stock_no' => '',
            'item' => 'required',
            'unit' => 'required',
            'quantity_issued' => 'required',
            'unit_cost' => 'required',
            'amount' => '',
        ]);

        $date = now();
        $month = $request->month;
        $year = $request->year;
        if (isEmpty($month)) {
            $month = $date->format('F');
        }
        if (isEmpty($year)) {
            $year = $date->format('Y');
        }
        $unit_cost = $request->unit_cost;
        $quantity_issued = $request->quantity_issued;
        $amount = $unit_cost * $quantity_issued;

        RSMI::create([
            'date' => $date,
            'month' => $month,
            'year' => $year,
            'fund_cluster' => $request->fund_cluster,
            'RIS_no' => $request->RIS_no,
            'office' => $request->office,
            'center_code' => $request->center_code,
            'stock_no' => $request->stock_no,
            'item' => $request->item,
            'unit' => $request->unit,
            'quantity_issued' => $quantity_issued,
            'unit_cost' => $unit_cost,
            'amount' => $amount,
        ]);

        $stockcard = StockCard::where('item', $request->item)->where('month', $month)->where('year', $year)->get();
        $description = '';
        $receipt_quantity = 0;
        $balance_quantity = 0;
        $days_consume = 0;
        $reference = '';
        $stock_no = '';
        if (!isEmpty($stockcard)) {
            $description = $stockcard->description;
            $receipt_quantity = $stockcard->receipt_quantity;
            $stock_no = $stockcard->stock_no;
            $reference = $stockcard->reference;
            $balance_quantity = $stockcard->balance_quantity;
            $days_consume = $stockcard->days_consume;
        }

        StockCard::create([
            'item' => $request->item,
            'description' => $description,
            'stock_no' => $stock_no,
            'date' => $date,
            'month' => $month,
            'year' => $year,
            'reference' => $reference,
            'receipt_quantity' => $receipt_quantity,
            'quantity' => $request->quantity_issued,
            'office' => $request->office,
            'balance_quantity' => $balance_quantity,
            'days_consume' => $days_consume,
        ]);

        $purchased_total_cost = $request->quantity_issued * $unit_cost;
        Inventory::create([
            'date' => $date,
            'month' => $month,
            'year' => $year,
            'item' => $request->item,
            'unit' => $request->unit,
            'quantity' => $request->quantity_issued,
            'purchased_supplies' => 0,
            'supplies_from_lingayen' => 0,
            'purchased_total_cost' => $purchased_total_cost,
            'lingayen_total_cost' => 0,
            'issued' => 0,
            'inventory_end' => 0,
            'unit_cost' => $unit_cost,
            'amount' => 0,
        ]);

        return redirect()->route('rsmi.edit', compact('month', 'year'));
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($month, $year)
    {
        //
        $rsmi = RSMI::where('month', $month)->where('year', $year)->get();
        $month = now()->format('F');
        $year = now()->format('Y');
        $grandTotal = RSMI::sum('amount');

        $grouped = $rsmi->groupBy('item');
        $result = $grouped->map(function ($group) {
            return [
                'item' => $group->first()->item,
                'total_quantity' => $group->sum('quantity_issued'),
                'total_unit_cost' => $group->first()->unit_cost * $group->first()->quantity_issued,
                'stock_no' => $group->first()->stock_no,
                'unit' => $group->first()->unit,
                'unit_cost' => $group->first()->unit_cost,
                'records' => $group,
            ];
        });

        return view('rsmi.edit', compact('rsmi', 'grandTotal', 'result', 'month', 'year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $rsmi)
    {
        //
        $request->validate([
            'date' => '',
            'month' => '',
            'year' => '',
            'fund_cluster' => '',
            'RIS_No' => '',
            'office' => '',
            'center_code' => '',
            'stock_no' => '',
            'item' => 'required',
            'unit' => 'required',
            'quantity_issued' => 'required',
            'unit_cost' => 'required',
            'amount' => '',
        ]);

        $date = now();
        $month = $request->month;
        $year = $request->year;
        if (isEmpty($month)) {
            $month = $date->format('F');
        }
        if (isEmpty($year)) {
            $year = $date->format('Y');
        }
        $unit_cost = $request->unit_cost;
        $quantity_issued = $request->quantity_issued;
        $amount = $unit_cost * $quantity_issued;
        $rsmi = RSMI::find($rsmi);
        $rsmi->update([
            'date' => $date,
            'month' => $month,
            'year' => $year,
            'fund_cluster' => $request->fund_cluster,
            'RIS_no' => $request->RIS_no,
            'office' => $request->office,
            'center_code' => $request->center_code,
            'stock_no' => $request->stock_no,
            'item' => $request->item,
            'unit' => $request->unit,
            'quantity_issued' => $quantity_issued,
            'unit_cost' => $unit_cost,
            'amount' => $amount,
        ]);



        $inventory = Inventory::where('month', $month)->where('year', $year)->first();
        $inventory->update([
            'date' => $date,
            'month' => $month,
            'year' => $year,
            'item' => $request->item,
            'unit' => $request->unit,
            'quantity' => $request->quantity_issued,
            'purchased_total_cost' => $amount,
            'unit_cost' => $unit_cost,
        ]);

        return redirect()->route('rsmi.edit', compact('month', 'year'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($RSMI)
    {
        //
        $rsmi = RSMI::find($RSMI);
        $item = $rsmi->item;
        $inventory = Inventory::where('item', $item)->first();
        $stockcard = StockCard::where('item', $item)->first();
        $inventory->delete();
        $stockcard->delete();
        $rsmi->delete();
        return back();
    }

    public function destroyMonth($month, $year)
    {
        //
        RSMI::where('month', $month)->where('year', $year)->delete();
        return redirect()->route('rsmi.index');
    }
}
