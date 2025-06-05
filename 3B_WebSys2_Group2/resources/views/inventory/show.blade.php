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
                            <th colspan="12" class="p-4">
                                <span class="fw-bold h4">{{ strtoupper($month) }} INVENTORY {{ $year }}</span><br>
                                <span class="fw-normal text-decoration-underline fw-bold h5">Pangasinan State
                                    University-Urdaneta
                                    Campus</span><br>
                                <span class="fw-normal fw-bold h6">Urdaneta City, Pangasinan</span>
                            </th>
                        </tr>
                        <tr class="align-middle text-end">
                            <th colspan="12">To be filled up by the Accounting Unit</th>
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
                            <tr class="align-middle">
                                <td>{{ $col->item }}</td>
                                <td>{{ $col->unit }}</td>
                                <td>{{ $col->quantity }}</td>
                                <td>{{$purchased_total_cost}}</td>
                                <td>{{ $col->purchased_supplies }}</td>
                                <td>{{ $col->supplies_from_lingayen }}</td>
                                <td>{{$lingayen_total_cost}}</td>
                                <td>{{ $col->issued }}</td>
                                <td>{{ $inventory_end }}</td>
                                <td>{{ $col->unit_cost }}</td>
                                <td>{{ $amount }}</td>
                                <td>{{ $issued_total_cost }}</td>
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