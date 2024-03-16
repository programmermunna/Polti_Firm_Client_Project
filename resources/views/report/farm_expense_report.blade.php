@extends('layout.master')
@section('content')
    <div class="row">
        <form style="width: 100%" action="{{ route('show.farm_expense_report') }}" method="post">
            @csrf
            <div class="d-flex">
                <div class="col-4">
                    <label for="">Start Date</label>
                    <input type="date" name="start_date" class="form-control">
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="">End Date</label>
                    <input type="date" name="end_date" class="form-control">
                    @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="">Search</label>
                    <input type="submit" value="Search" class="form-control btn btn-sm btn-primary">
                </div>
            </div>
        </form>

        <!-- Display the fetched data -->
        @if(isset($farmCosts))
            <div style="width:100%;background-color: #fff;" class="mt-4">
                <div class="report_block">
                    <img src="{{ asset("custom/logos/")."/".$settings->project_logo }}" alt="logo images">
                    <h2 style="text-transform: uppercase;">{{ $settings->project_name }}</h2>
                    <h4>Branch  {{ session('branch_id') }}</h4>
                    <h4>Farm Expense Report</h4>
                    <h4> from {{ $startDate }} to {{ $endDate }}</h4>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S\L</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($farmCosts as $sale)
                            <tr>
                                <td>{{ $sl }}</td>
                                <td>{{ dateTimeFormat($sale->cost_date) }}</td>
                                <td>{{ ucfirst($sale->expenseTypes->name) }}</td>
                                <td>{{ $sale->cost_amount }}</td>
                                <td>{{ $sale->description }}</td>
                            </tr>
                            @php
                                $sl++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>

                <!-- Print button -->
                <button onclick="window.print()" class="btn btn-sm btn-secondary">Print Report</button>
            </div>
        @endif

    </div>
@endsection