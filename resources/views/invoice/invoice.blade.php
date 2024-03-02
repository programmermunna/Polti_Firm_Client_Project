@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Invoice Design <small>Sample user invoice design</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false"><i class="fa fa-wrench"></i></a>
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

                    <section class="content invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="  invoice-header">
                                <h1>
                                    <small class="pull-right">Date: {{ dateTimeFormat($poltiSellInfo->created_at) }}</small>
                                </h1>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    <strong>{{ auth()->user()->name }}</strong>
                                    <br>IMPEX AGRO FARM
                                    <br>Dhaka , Bangladesh
                                    <br>Phone: {{ auth()->user()->phone_number }}
                                    <br>Email: {{ auth()->user()->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{ $poltiSellInfo->buyer->name }}</strong>
                                    <br>{{ $poltiSellInfo->buyer->address }}
                                    <br>Bangladesh, CA 94107
                                    <br>Phone: {{ $poltiSellInfo->buyer->phone_number }}
                                    <br>Email: jon@ironadmin.com
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #{{ $poltiSellInfo->id }}</b>
                                <br>
                                <br>
                                <b>Order ID:</b> {{ $poltiSellInfo->id }}
                                <br>
                                <b>Payment Due:</b> {{ dateTimeFormat($poltiSellInfo->created_at) }}
                                <br>
                                <b>Account:</b> 968-34567
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="  table">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>polti</th>
                                            <th>Serial #</th>
                                            <th style="width: 59%">Description</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($poltis) > 0)
                                            @foreach ($poltis as $key => $polti)
                                                <tr>
                                                    <td>1</td>
                                                    <td style="color:#000; font-weight:bold;">
                                                        {{ '#' . $polti->polti->tag }}
                                                    </td>
                                                    <td>{{ $polti->id }}</td>
                                                    <td>
                                                        {{ $polti->description }}
                                                    </td>
                                                    <td>{{ number_format($polti->price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>1</td>
                                                <td style="color:#000; font-weight:bold;">
                                                    {{ '#' . $poltiSellInfo->polti->tag }}
                                                </td>
                                                <td>{{ $poltiSellInfo->id }}</td>
                                                <td>
                                                    {{ $poltiSellInfo->description }}
                                                </td>
                                                <td>{{ number_format($poltiSellInfo->price, 2) }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-md-6">
                                <p class="lead">Payment Methods:</p>
                                <img src="{{ asset('asset/images/visa.png') }}" alt="Visa">
                                <img src="{{ asset('asset/images/mastercard.png') }}" alt="Mastercard">
                                <img src="{{ asset('asset/images/american-express.png') }}" alt="American Express">
                                <img src="{{ asset('asset/images/paypal.png') }}" alt="Paypal">
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    At Impex Agro Farm, we prioritize convenience and security in every transaction. Whether
                                    you're purchasing our premium farm produce or engaging in a business partnership, we
                                    offer a range of reliable payment methods to suit your needs.
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <p class="lead">Amount Due 2/22/2014</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>{{ number_format($poltiSellInfo->price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Payment</th>
                                                <td>{{ number_format($poltiSellInfo->payment, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Due:</th>
                                                <td>{{ number_format($poltiSellInfo->due, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>{{ number_format($poltiSellInfo->price, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class=" ">
                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i>
                                    Print</button>
                                <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit
                                    Payment</button>
                                <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i
                                        class="fa fa-download"></i> Generate PDF</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
