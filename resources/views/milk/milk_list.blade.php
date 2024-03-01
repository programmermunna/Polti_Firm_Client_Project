@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">
            @if (session('message'))
                <div class="alert alert-success" id="sessionMessage">
                    {{ session('message') }}
                </div>
            @endif

            <div class="page_header">
                <div class="page_header_menu">
                    <a class="btn btn-sm btn-primary" href="{{ route('milk.create') }}">Add Milk</a>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Milk List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Litre</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($milks as $key => $milk)
                                <tr>
                                    <th scope="row">
                                        <mark>{{ $sl }}</mark>
                                    </th>
                                    <td>
                                        <mark class="order-mark">{{ dateTimeFormat($milk->milk_date) }}</mark>
                                    </td>
                                    <td>
                                        <mark class="primary-mark">{{ $milk->total_quantity }}</mark>
                                    </td>
                                    <td style="font-weight: bold; color:#000;">{{ auth()->user()->name }}</td>
                                    <td>
                                        <a href="{{ route('milk_sell.view', ['date' => $milk->milk_date]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $sl++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection