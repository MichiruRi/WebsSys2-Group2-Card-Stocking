<?php

namespace App\Http\Controllers;

use App\Models\StockCard;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class StockCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stockcard = StockCard::all();
        $years = StockCard::selectRaw('year')
            ->groupBy('year')
            ->get();
        $select_year = request()->input('select_year');
        $search = request()->input('search');
        if (!empty($select_year) || !empty($search)) {
            $stockcard = StockCard::where('year', $select_year)->orWhere('item', $search)->get();
        }

        return view('stockcard.index', compact('stockcard', 'years'));
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
    public function show($item, $year)
    {
        //
        $stockcard = StockCard::where('item', $item)->where('year', $year)->get();

        $description = $stockcard->first()->description;
        $stock_no = $stockcard->first()->stock_no;

        return view('stockcard.show', compact('stockcard', 'item', 'description', 'stock_no'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($item, $year)
    {
        //
        $stockcard = StockCard::where('item', $item)->where('year', $year)->get();

        $description = $stockcard->first()->description;
        $stock_no = $stockcard->first()->stock_no;

        return view('stockcard.edit', compact('stockcard', 'item', 'description', 'stock_no', 'year'));
    }

    public function updateDesc(Request $request, $item, $year)
    {
        //
        $stockcard = StockCard::where('item', $item)->where('year', $year)->get();

        StockCard::where('item', $item)
            ->where('year', $year)
            ->update(['description' => $request->description]);

        $description = $stockcard->first()->description;
        $stock_no = $stockcard->first()->stock_no;

        return redirect()->route('stockcard.edit', compact('stockcard', 'item', 'description', 'stock_no', 'year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $stockCard)
    {
        //
        $stockCard = StockCard::find($stockCard);
        $item = $request->item;
        $year = $request->year;
        if ($stockCard->reference == 'beginning_balance') {
            $stockCard->update([
                'description' => '',
                'stock_no' => '',
                'year' => $year,
                'reference' => 'beginning_balance',
                'receipt_quantity' => $request->receipt_quantity,
                'quantity' => 0,
                'office' => '',
                'balance_quantity' => $request->receipt_quantity,
                'days_consume' => 0,
            ]);
        } else {
            $reference = $request->reference;
            $days_consume = $request->days_consume;
            $receipt_quantity = $request->receipt_quantity;
            if (isEmpty($reference)) {
                $reference = '';
            }
            $stockCard->update([
                'reference' => $reference,
                'receipt_quantity' => $receipt_quantity,
                'days_consume' => $days_consume,
            ]);
        }
        return redirect()->route('stockcard.edit', compact('item', 'year'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($stockCard)
    {
        //
    }

    public function destroyYear($item, $year)
    {
        //
        StockCard::where('item', $item)->where('year', $year)->delete();
        return redirect()->route('stockcard.index');
    }
}
