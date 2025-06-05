@extends('layouts.app')
@section('sidebar')
    <nav class="sidebar d-flex flex-column">
        <img class="w-50 m-3 mx-auto d-block" src="{{ asset('images/PSU_logo.png') }}" alt="PSU LOGO">
        <h4 class="text-white">Card Stocking</h4>
        <ul class="nav flex-column nav-pills me-3 ms-3">
            <li class="nav-item">
                <a class="nav-link custom-nav" href="/rsmi">RSMI</a>
            </li>
            <li class="nav-item">
                <a class="nav-link custom-nav active" href="/inventory">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link custom-nav" href="/stockcard">Stock Cards</a>
            </li>
        </ul>
    </nav>
@endsection
@section('content')

    <body>
        <div class="content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm text-center">
                    <thead>
                        <tr>
                            <th colspan="13" class="p-4">
                                <span class="fw-bold h4">{{ strtoupper($month) }} INVENTORY {{ $year }}</span><br>
                                <span class="fw-normal text-decoration-underline fw-bold h5">Pangasinan State
                                    University-Urdaneta
                                    Campus</span><br>
                                <span class="fw-normal fw-bold h6">Urdaneta City, Pangasinan</span>
                            </th>
                        </tr>
                        <tr class="align-middle text-end">
                            <th colspan="12">To be filled up by the Accounting Unit</th>
                            <th></th>
                        </tr>
                        <tr class="align-middle">
                            <th>Item</th>
                            <th>Unit</th>
                            <th>Qty.</th>
                            <th></th>
                            <th>Purchase Supplies and Materials (FUND 05-206441)</th>
                            <th>Received Supplies and Materials From Lingayen</th>
                            <th></th>
                            <th>Issued</th>
                            <th>Inventory End</th>
                            <th>Unit Cost</th>
                            <th>Amount</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $purchased_total_cost = 0;
                            $lingayen_total_cost = 0;
                            $inventory_end = 0;
                            $issued_total_cost = 0;
                            $amount = 0;

                            $purchased_total_total = 0;
                            $lingayen_total_total = 0;
                            $issued_total_total = 0;
                            $amount_total = 0;
                        @endphp
                        @foreach ($inventory as $col)
                            @php
                                $purchased_total_cost = $col->quantity * $col->unit_cost;
                                $lingayen_total_cost = $col->supplies_from_lingayen * $col->unit_cost;
                                $inventory_end = $col->quantity + $col->purchased_supplies + $col->supplies_from_lingayen - $col->issued;
                                $amount = $inventory_end * $col->unit_cost;
                                $issued_total_cost = $col->issued * $col->unit_cost;

                                $purchased_total_total += $purchased_total_cost;
                                $lingayen_total_total += $lingayen_total_cost;
                                $issued_total_total += $issued_total_cost;
                                $amount_total += $amount;
                            @endphp
                            <form action="{{ route('stockcard.update', ['stockcard' => $col->id]) }}" method="post">
                                <tr class="align-middle">
                                    <td><input class="form-control" type="text" name="item" value="{{ $col->item }}" readonly>
                                    </td>
                                    <td><input class="form-control" type="text" name="unit" value="{{ $col->unit }}" readonly>
                                    </td>
                                    <td><input class="form-control" type="number" name="quantity" value="{{ $col->quantity }}"
                                            readonly>
                                    </td>
                                    <td><input class="form-control" type="number" name="number" step="0.01"
                                            value="{{ $purchased_total_cost }}" readonly></td>
                                    <td><input class="form-control" type="number" name="purchased_supplies"
                                            value="{{ $col->purchased_supplies }}"></td>
                                    <td><input class="form-control" type="number" name="supplies_from_lingayen"
                                            value="{{ $col->supplies_from_lingayen }}"></td>
                                    <td><input class="form-control" type="number" name="number" step="0.01"
                                            value="{{ $lingayen_total_cost }}"></td>
                                    <td><input class="form-control" type="number" name="issued" value="{{ $col->issued }}"
                                            readonly></td>
                                    <td><input class="form-control" type="number" name="inventory_end"
                                            value="{{ $inventory_end }}" readonly>
                                    </td>
                                    <td><input class="form-control" type="number" name="unit_cost" step="0.01"
                                            value="{{ $col->unit_cost }}" readonly></td>
                                    <td><input class="form-control" type="number" name="amount" step="0.01"
                                            value="{{ $amount }}" readonly></td>
                                    <td><input class="form-control" type="number" name="" step="0.01"
                                            value="{{ $issued_total_cost }}" readonly></td>
                                    <td class="d-flex justify-content-center align-items-center gap-2 p-3">
                                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </form>
                            </tr>

                        @endforeach
                    </tbody>
                    <thead>
                        <tr class="align-middle">
                            <th></th>
                            <th colspan="3" class="text-end fw-bold fst-italic">
                                GRAND TOTAL
                            </th>
                            <th>{{$purchased_total_total}}</th>
                            <th></th>
                            <th>{{$lingayen_total_total}}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{$amount_total}}</th>
                            <th>{{$issued_total_total}}</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </body>
@endsection

<style>
    th {
        font-weight: normal;
    }
</style>