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
    <div class="content mt-4">
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex align-items-center gap-2 justify-content-end">
                    <form class="d-inline-flex m-0 p-0 gap-2" action="" method="get">
                        <input class="form-control text-start" type="text" class="form-control w-50" placeholder="Search"
                            name="search" value="{{ request('search') }}" />
                        <select class="form-control" style="width:auto" name="select_month">
                            <option value="">Select Month</option>
                            @foreach ($months as $m)
                                <option value="{{ $m['month'] }}" {{ request('select_year') == $m['month'] ? 'selected' : '' }}>
                                    {{ $m['month'] }}
                                </option>
                            @endforeach
                        </select>
                        <select class="form-control" style="width:auto" name="select_year">
                            <option value="">Select Year</option>
                            @foreach ($years as $y)
                                <option value="{{ $y['year'] }}" {{ request('select_year') == $y['year'] ? 'selected' : '' }}>
                                    {{ $y['year'] }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-secondary" type="submit">Filter</button>
                    </form>
                    <form action="" method="get">
                        <input type="hidden" name="search" value="">
                        <input type="hidden" name="select_year" value="">
                        <input type="hidden" name="select_month" value="">
                        <button class="btn btn-danger" type="submit">Clear</button>
                    </form>
                    <a href="/rsmi/edit/{{$month}}/{{$year}}"><button class="btn btn-success" type="submit">Add
                            New</button></a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr class="align-middle">
                        <th>Month</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rsmi as $col)
                        <tr class="align-middle">
                            <td>{{ $col->month }}</td>
                            <td>{{ $col->year }}</td>
                            <td class="d-flex align-items-center  gap-2">
                                <a href="rsmi/show/{{ $col->month }}/{{ $col->year }}" class="btn btn-sm btn-primary">View</a>
                                <a href="rsmi/edit/{{ $col->month }}/{{ $col->year }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('rsmi.destroyMonth', ['month' => $col->month, 'year' => $col->year]) }}"
                                    method="POST" onsubmit="return confirm('Are you sure?');" class="mb-0 d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection