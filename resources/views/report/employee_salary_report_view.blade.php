@extends('layout.master')
@section('content')
    <div class="row">
        @php
            $monthNumber = $month;
            $monthName = DateTime::createFromFormat('!m', $monthNumber)->format('F');
        @endphp

        <!-- Display the fetched data -->
        @if(isset($salaries))
            <div style="width:100%;background-color: #fff;" class="mt-4">
                <div class="report_block">
                    <img src="{{ asset('custom/logos/logo.png') }}" alt="no images">
                    <h2 style="text-transform: uppercase;">impex agro farm</h2>
                    <h4>Branch  {{ session('branch_id') }}</h4>
                    <h4>Employee Salary Report</h4>
                    <h4> for {{ $monthName }} in {{ $year }}</h4>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S\L</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach($salaries as $sale)
                            <tr>
                                <td>{{ $sl }}</td>
                                <td>{{ dateTimeFormat($sale->paid_on) }}</td>
                                <td>{{ ucfirst($sale->staff->name) }}</td>
                                <td>{{ $monthName }}</td>
                                <td>{{ $year }}</td>
                                <td>{{ number_format($sale->amount,2) }}</td>
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