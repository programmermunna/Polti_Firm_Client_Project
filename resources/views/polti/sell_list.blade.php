@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">

            <div class="page_header">
                <div class="page_header_menu">
                    <a class="btn btn-sm btn-primary" href="{{ route('polti.sell') }}">Add Sell</a>
                </div>
            </div>

            @if (session('message'))
                <div class="alert alert-success" id="sessionMessage">
                    {{ session('message') }}
                </div>
            @endif

            <div class="x_panel">

                <div class="x_title">
                    <h2>Sell List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li>
                            <a class="close-link">
                                <i class="fa fa-close"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Branch</th>
                                            <th>Buyer</th>
                                            <th>piece</th>
                                            <th>Price</th>
                                            <th>Payment</th>
                                            <th>Due</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @if (count($sellList) > 0)
                                            @foreach ($sellList as $key => $sell)
                                                <tr class="list-item">
                                                    <td>{{ ucfirst($sell->branch->branch_name) }}</td>
                                                    <td style="color: blue; font-weight:bold;">
                                                        {{ ucfirst($sell->buyer->name) }}</td>
                                                    <td style="color: #000; font-weight:bold;">
                                                        {{ $sell->piece }}</td>
                                                    <td style="color: #000; font-weight:bold;">
                                                        {{ number_format($sell->price, 2) }}</td>
                                                    <td style="color: #000; font-weight:bold;">
                                                        {{ number_format($sell->payment, 2) }}</td>
                                                    <td style="color: red; font-weight:bold;">
                                                        {{ number_format($sell->due, 2) }}</td>
                                                    <td>{{ ucfirst($sell->polti->category->name) }}</td>
                                                    <td>{{ dateTimeFormat($sell->sell_date) }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary editBtn" data-toggle="modal"
                                                            data-target="#myModal" data-id="{{ $sell->id }}"
                                                            data-polti_id="{{ $sell->polti->id }}"
                                                            data-piece="{{ $sell->piece }}"
                                                            data-price="{{ $sell->price }}"
                                                            data-due="{{ $sell->due }}"
                                                            data-status="{{ $sell->status }}"
                                                            data-payment="{{ $sell->payment }}"
                                                            data-buyer="{{ $sell->buyer->id }}"
                                                            data-name="{{ $sell->name }}"
                                                            data-status="{{ $sell->status }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger deleteButton"
                                                            data-id="{{ $sell->id }}">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                        <a href="{{ route('sell.invoice', ['id' => $sell->id]) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fa-solid fa-file-invoice"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <p>There is no data</p>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
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

                    <form class="" action="{{ route('polti_sell.edit') }}" method="post" novalidate>
                        @csrf
                        <span class="section">polti Sell Info</span>

                        <input type="hidden" name="sell_id">

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">পোল্টি<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select name="polti_id" id="" class="form-control" required="required">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($poltis as $key => $polti)
                                        <option value="{{ $polti->id }}">{{ $polti->tag }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('polti_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রেতা<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select name="buyer_id" id="" class="form-control" required="required">
                                    <option value="" selected disabled>Select</option>
                                    @foreach ($buyers as $key => $buyer)
                                        <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('buyer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">সংখ্যা<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="piece" required="required" />
                            </div>
                            @error('piece')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">মূল্য<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="price" required="required" />
                            </div>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">পেমেন্ট<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="payment" required="required" />
                            </div>
                            @error('payment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">বাকি<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="due" required="required" />
                            </div>
                            @error('due')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">বিক্রয় তারিখ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" class='sell_date' type="date" name="sell_date"
                                    required='required'>
                            </div>
                            @error('sell_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">অবস্থা<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                        data-toggle-passive-class="btn-default">
                                        <input type="radio" name="status" value="0" class="join-btn"> &nbsp;
                                        Delivered &nbsp;
                                    </label>
                                    <label class="btn btn-primary" data-toggle-class="btn-primary"
                                        data-toggle-passive-class="btn-default">
                                        <input type="radio" name="status" value="1" class="join-btn"> Booking
                                    </label>
                                </div>
                            </div>
                            @error('status')
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
        $(document).ready(function() {
            $('.deleteButton').click(function() {
                var sellId = $(this).data('id');
                var listItem = $(this).closest(
                    '.list-item'); // Adjust the selector based on your HTML structure

                // Use SweetAlert to confirm the deletion
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, send an AJAX request to delete the pigeon
                        $.ajax({
                            type: 'GET',
                            url: '/sell/polti/delete/' + sellId,
                            success: function(response) {
                                // Remove the deleted item from the DOM
                                listItem.remove();

                                // Show a success message
                                Swal.fire('Deleted!', response.message, 'success');
                            },
                            error: function(error) {
                                // Show an error message
                                Swal.fire('Error!', error.responseJSON.message,
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        // Wait for the DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Get the session message element
            let sessionMessage = document.getElementById('sessionMessage');

            // Check if the element exists
            if (sessionMessage) {
                // Hide the session message after 3 seconds (3000 milliseconds)
                setTimeout(function() {
                    sessionMessage.style.display = 'none'; // Hide the element
                }, 3000);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.editBtn').click(function() {
                // alert($(this).data('polti'));
                const sellData = {
                    id: $(this).data('id'),
                    polti: $(this).data('polti_id'),
                    buyer: $(this).data('buyer'),
                    payment: $(this).data('payment'),
                    piece: $(this).data('piece'),
                    price: $(this).data('price'),
                    due: $(this).data('due'),
                    tag: $(this).data('tag'),
                    status: $(this).data('status'),
                };

                // Set values to form fields
                $('input[name="sell_id"]').val(sellData.id);
                $('select[name="polti_id"]').val(sellData.polti);
                $('input[name="due"]').val(sellData.due);
                $('input[name="piece"]').val(sellData.piece);
                $('input[name="price"]').val(sellData.price);
                $('input[name="payment"]').val(sellData.payment);
                $('input[name="tag"]').val(sellData.tag);
                $('select[name="buyer_id"]').val(sellData.buyer);
                $('input[name="status"]').val(sellData.status);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('input[name="payment"]').on('input', function() {
                var price = $('input[name="price"]').val();
                var payment = $('input[name="payment"]').val();

                var due = price - payment;

                $('input[name="due"]').val(due.toFixed(2));
            });
        });
    </script>
@endsection
