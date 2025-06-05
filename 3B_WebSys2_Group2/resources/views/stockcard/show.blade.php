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
                <a class="nav-link custom-nav" href="/inventory">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link custom-nav active" href="/stockcard">Stock Cards</a>
            </li>
        </ul>
    </nav>
@endsection
@section('content')

    <body>
        <div class="content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr class="text-center">
                            <th colspan="7" class="p-4">
                                <span class="fw-bold h4">STOCK CARD</span><br>
                                <span class="fw-normal text-decoration-underline h5">PSU-Urdaneta Campus</span><br>
                                <span class="fw-normal fw-bold">Agency</span>
                            </th>
                        </tr>
                        <tr class="text-center align-middle">
                            <th>Item: </th>
                            <th colspan="2" class="fw-bold">{{$item}}</th>
                            <th>Description: </th>
                            <th class="fw-bold">
                                {{$description}}
                            </th>
                            <th>Stock #:</th>
                            <th class="fw-bold">{{ $stock_no }}</th>
                        </tr>
                        <tr class="text-center align-middle">
                            <th rowspan="2">Date</th>
                            <th rowspan="2">Reference</th>
                            <th rowspan="2">Receipt Qty</th>
                            <th colspan="2">ISSUANCE</th>
                            <th rowspan="2">Balance Qty</th>
                            <th rowspan="2">No. of Days Consume</th>
                        </tr>
                        <tr class="text-center">
                            <th>Qty</th>
                            <th>Office</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $balance_quantity = 0;
                            $start = 0;
                        @endphp
                        @foreach ($stockcard as $col)
                            @php
                                $balance_quantity += $col->receipt_quantity;
                                $balance_quantity -= $col->quantity;
                            @endphp
                            <tr class="align-middle text-center">
                                <td>{{$col->date}}</td>
                                <td>{{$col->reference}}</td>
                                <td>{{$col->receipt_quantity}}</td>
                                <td>{{$col->quantity}}</td>
                                <td>{{$col->office}}</td>
                                <td>{{$balance_quantity}}</td>
                                <td>{{$col->days_consume}}</td>
                            </tr>
                        @endforeach
                    </tbody>
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