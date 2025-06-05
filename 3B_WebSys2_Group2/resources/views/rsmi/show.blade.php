@extends('layouts.app')
@section('sidebar')
    <nav class="sidebar d-flex flex-column">
        <img class="w-50 m-3 mx-auto d-block" src="{{ asset('images/PSU_logo.png') }}" alt="PSU LOGO">
        <h4 class="text-white">Card Stocking</h4>
        <ul class="nav flex-column nav-pills me-3 ms-3">
            <li class="nav-item">
                <a class="nav-link custom-nav active" href="/rsmi">RSMI</a>
            </li>
            <li class="nav-item">
                <a class="nav-link custom-nav" href="/inventory">Inventory</a>
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
                            <th colspan="11" class="p-4">
                                <span class="fw-bold h4">MONTHLY REPORT OF SUPPLIES AND MATERIALS USED</span><br>
                                <span class="fw-normal text-decoration-underline fw-bold h5">Pangasinan State
                                    University-Urdaneta
                                    Campus</span>
                            </th>
                        </tr>
                        <tr>
                            <th class="align-middle">Date: </th>
                            <th colspan="10" class="fw-bold text-start ps-3">
                                {{ $month }} {{ $year }}
                            </th>
                        </tr>
                        <tr class="align-middle">
                            <th colspan="8">To be filled up in the Supply and Property Unit</th>
                            <th colspan="2">To be filled up by the <br>Accounting Unit</th>
                        </tr>
                        <tr class="align-middle">
                            <th>RIS No.</th>
                            <th>Fund Cluster</th>
                            <th>Department Office Visited</th>
                            <th>Responsibility Center Code</th>
                            <th>Stock No.</th>
                            <th>Item</th>
                            <th>Unit</th>
                            <th>Qty. Issued</th>
                            <th>Unit Cost</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rsmi as $col)
                            <tr class="align-middle">
                                <td>{{ $col->fund_cluster }}</td>
                                <td>{{ $col->RIS_no }}</td>
                                <td>{{ $col->office }}</td>
                                <td>{{ $col->center_code }}</td>
                                <td>{{ $col->stock_no }}</td>
                                <td>{{ $col->item }}</td>
                                <td>{{ $col->unit }}</td>
                                <td>{{ $col->quantity_issued }}</td>
                                <td>{{ $col->unit_cost }}</td>
                                <td>{{ $col->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr class="align-middle">
                            <th colspan="9" class="text-end fw-bold fst-italic">
                                GRAND TOTAL
                            </th>
                            <th class="fw-bold">
                                {{$grandTotal}}
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm text-center">
                    <thead>
                        <tr>
                            <th colspan="6" class="fw-bold p-3 h5">RECAPITULATION</th>
                        </tr>
                        <tr>
                            <th>Stock No.</th>
                            <th>Qty.</th>
                            <th>Item</th>
                            <th>Unit</th>
                            <th>Unit Cost</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $col)
                            <tr>
                                <td>{{ $col['stock_no'] }}</td>
                                <td>{{ $col['total_quantity'] }}</td>
                                <td>{{ $col['item'] }}</td>
                                <td>{{ $col['unit'] }}</td>
                                <td>{{ $col['unit_cost'] }}</td>
                                <td>{{ $col['total_unit_cost'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr class="align-middle">
                            <th colspan="5" class="text-end fw-bold fst-italic">
                                GRAND TOTAL
                            </th>
                            <th class="fw-bold">
                                {{$grandTotal}}
                            </th>
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