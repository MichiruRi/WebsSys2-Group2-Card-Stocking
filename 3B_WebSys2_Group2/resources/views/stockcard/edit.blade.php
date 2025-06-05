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
                            <th colspan="8" class="p-4">
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
                                <form class="m-0 p-0"
                                    action="{{ route('stockcard.updateDesc', ['item' => $item, 'year' => $year]) }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')
                                    <input class="form-control" type="text" name="description" value="{{$description}}">
                                </form>
                            </th>
                            <th>Stock #:</th>
                            <th class="fw-bold">{{ $stock_no }}</th>
                            <th></th>
                        </tr>
                        <tr class="text-center align-middle">
                            <th rowspan="2">Date</th>
                            <th rowspan="2">Reference</th>
                            <th rowspan="2">Receipt Qty</th>
                            <th colspan="2">ISSUANCE</th>
                            <th rowspan="2">Balance Qty</th>
                            <th rowspan="2">No. of Days Consume</th>
                            <th rowspan="2">Actions</th>
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
                            <tr class="align-middle">
                                <form
                                    action="{{ route('stockcard.update', ['stockcard' => $col->id, 'item' => $col->item, 'year' => $col->year]) }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')
                                    <td><input class="form-control" type="date" name="date" value="{{$col->date}}"></td>
                                    <td><input class="form-control" type="text" name="reference" value="{{$col->reference}}">
                                    </td>
                                    <td><input class="form-control" type="text" name="receipt_quantity"
                                            value="{{$col->receipt_quantity}}"></td>
                                    <td><input class="form-control" type="text" name="quantity" value="{{$col->quantity}}"
                                            readonly></td>
                                    <td><input class="form-control" type="text" name="office" value="{{$col->office}}" readonly>
                                    </td>
                                    <td><input class="form-control" type="number" name="balance_quantity"
                                            value="{{$balance_quantity}}" readonly></td>
                                    <td><input class="form-control" type="number" name="days_consume"
                                            value="{{$col->days_consume}}"></td>
                                    <td class="d-flex justify-content-center align-items-center gap-2 p-3">
                                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </form>
                                </td>
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