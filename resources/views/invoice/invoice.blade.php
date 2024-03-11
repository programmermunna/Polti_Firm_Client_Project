@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <div style="text-align: center">
                        <img style="width: 30px; height:30px; border-radius:50%;" src="{{ asset("custom/logos/")."/".session("project_logo") }}" alt="">
                        <span style="font-size: 20px">{{ session("project_name") }}</span> 
                    </div>
                <div class="x_content">

                    <section class="content invoice">
                        <!-- title row -->
                        <br>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                From
                                <address>
                                    {{ $settings->project_name }}
                                    <br>Phone: {{ $settings->project_phone }}
                                    <br>Email: {{ $settings->project_email }}
                                    <br>Address: {{ $settings->project_address }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                To
                                <address>
                                    <strong>{{ $poltiSellInfo->buyer->name }}</strong>
                                    <br>Phone: {{ $poltiSellInfo->buyer->phone_number }}
                                    <br>Address: {{ $poltiSellInfo->buyer->address }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Invoice</b> <b style="font-weight:bolder">({{ date("d-M-Y") }})</b>
                                <br>
                                <b>Order ID:</b> #{{ $poltiSellInfo->id }}
                                <br>
                                Payment Due: {{ $poltiSellInfo->due }}
                                <br>
                                Order Date: {{ dateTimeFormat($poltiSellInfo->created_at) }}
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
                                            <th>Category</th>
                                            <th>KG</th>
                                            <th>Piece</th>
                                            <th>Pirce</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $poltiSellInfo->category->name }}</td>
                                            <td>{{ $poltiSellInfo->kg }}</td>
                                            <td>{{ $poltiSellInfo->piece }}</td>
                                            <td>{{ number_format($poltiSellInfo->price, 2) }}</td>
                                            <td>{{ number_format($poltiSellInfo->price, 2) }}</td>
                                        </tr>
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
                                    At Isbah Polti Firm, we prioritize convenience and security in every transaction. Whether
                                    you're purchasing our premium farm produce or engaging in a business partnership, we
                                    offer a range of reliable payment methods to suit your needs.
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <p class="lead">Order Checkout</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>{{ number_format($poltiSellInfo->price, 2) }}</td>
                                            </tr>
                                            <tr style="color:green">
                                                <th>Payment</th>
                                                <td>{{ number_format($poltiSellInfo->payment, 2) }}</td>
                                            </tr>
                                            <tr style="color:red">
                                                <th>Due:</th>
                                                <td>{{ number_format($poltiSellInfo->due, 2) }}</td>
                                            </tr>
                                            <tr style="font-size:20px;font-weight:bolder;">
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
                                <button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i>
                                    Print</button>
                                {{-- <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit
                                    Payment</button>
                                <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i
                                        class="fa fa-download"></i> Generate PDF</button> --}}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
