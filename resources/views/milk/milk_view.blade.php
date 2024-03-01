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
                    <a class="btn btn-sm btn-primary" href="{{ route('milk.list') }}">Milk List</a>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Milk List for <small style="font-weight: bold; font-size:20px; color:teal;">{{ dateTimeFormat($date) }}</small></h2>
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
                                <th>Cow ID</th>
                                <th>Tag</th>
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
                                        <mark class="tag-mark">{{ $milk->cow_id }}</mark>
                                    </td>
                                    <td>
                                        <mark class="tag-mark">{{ '#'.$milk->cow->tag }}</mark>
                                    </td>
                                    <td>
                                        <mark class="primary-mark">{{ number_format($milk->quantity, 2) }}</mark>
                                    </td>
                                    <td style="font-weight: bold; color:#000;">{{ auth()->user()->name }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary editBtn" data-toggle="modal"
                                            data-id="{{ $milk->id }}" data-cow_id="{{ $milk->cow_id }}"
                                            data-quantity="{{ $milk->quantity }}"
                                            data-target="#myModal">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
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

    <!-- Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Edit Info</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form class="" action="{{ route('milk.edit') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="sell_id">


                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Tag<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="cow_id" id="" class="form-control">
                                <option value="" selected disabled>select</option>
                                @foreach ($cows as $key => $cow)
                                    <option value="{{ $cow->id }}">{{ $cow->tag }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('cow_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Quantity<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="quantity" type="text" required="required" />
                        </div>
                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary">Update</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            </div>
        </div>
    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function(){
            $('.editBtn').click(function(){
                // alert($(this).data('id'));
                // return false;
                const sellData = {
                    id: $(this).data('id'),
                    cow_id: $(this).data('cow_id'),
                    quantity: $(this).data('quantity'),
                };

                // Set values to form fields
                $('input[name="sell_id"]').val(sellData.id);
                $('input[name="quantity"]').val(sellData.quantity);
                $('select[name="cow_id"]').val(sellData.cow_id);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection