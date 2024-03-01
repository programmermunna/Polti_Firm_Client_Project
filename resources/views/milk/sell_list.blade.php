@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">

            <div class="page_header">
                <div class="page_header_menu">
                    <a class="btn btn-sm btn-primary" href="{{ route('milk_sell.collect') }}">Due List</a>
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
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Due</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @if (count($sellList) > 0)
                                            @foreach ($sellList as $key => $sell)
                                                <tr class="list-item">
                                                    <td>{{ ucfirst($sell->name) }}</td>
                                                    <td>{{ $sell->quantity }}</td>
                                                    <td>{{ number_format($sell->price, 2) }}</td>
                                                    <td>{{ number_format($sell->price * $sell->quantity, 2) }}</td>
                                                    <td>{{ number_format($sell->payment, 2) }}</td>
                                                    <td style="font-weight:bold; color:red;">
                                                        {{ number_format($sell->due, 2) }}</td>
                                                    <td>
                                                        @if ($sell->due <= 0)
                                                            <label class="btn btn-sm btn-primary">Paid</label>
                                                        @else
                                                            <label class="btn btn-sm btn-warning text-dark">Non Paid</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary editBtn" data-toggle="modal"
                                                            data-target="#myModal" data-id="{{ $sell->id }}"
                                                            data-name="{{ $sell->name }}"
                                                            data-quantity="{{ $sell->quantity }}"
                                                            data-price="{{ $sell->price }}"
                                                            data-payment="{{ $sell->payment }}"
                                                            data-due="{{ $sell->due }}"
                                                            data-phone="{{ $sell->phone_number }}"">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger deleteButton"
                                                            data-id="{{ $sell->id }}">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                        <a href="" class="btn btn-sm btn-secondary"
                                                            data-id="{{ $sell->id }}">
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

                    <form class="" action="{{ route('milk.sell_edit') }}" method="post" novalidate>
                        @csrf

                        <input type="hidden" name="sell_id">
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">কাস্টমারের নাম<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="name" type="text" required="required" />
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">গোশতের পরিমাণ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="quantity" name="quantity" placeholder="in kg*"
                                    type="text" required="required" />
                            </div>
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">মূল্য<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="price" name="price" placeholder="per kg*"
                                    type="text" required="required" />
                                <p id="bill" style="margin-bottom: 0; color:darkblue; font-weight:bold;"></p>
                            </div>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">সর্বমোট<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="price" name="total" placeholder="per kg*"
                                    type="text" required="required" />
                                <p id="bill" style="margin-bottom: 0; color:darkblue; font-weight:bold;"></p>
                            </div>
                            @error('total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">পেমেন্ট<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="payment" name="payment" type="text"
                                    required="required" />
                            </div>
                            @error('payment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">বাকি<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="due" type="text" required="required" />
                            </div>
                            @error('due')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">কাস্টমারের ফোন<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="phone_number" type="text" placeholder="+880"
                                    required="required" />
                            </div>
                            @error('phone_number')
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
                            url: '/beef/sell/delete/' + sellId,
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
                const beefData = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    quantity: $(this).data('quantity'),
                    price: $(this).data('price'),
                    payment: $(this).data('payment'),
                    due: $(this).data('due'),
                    phone: $(this).data('phone'),
                };

                // Set values to form fields
                $('input[name="sell_id"]').val(beefData.id);
                $('input[name="name"]').val(beefData.name);
                $('input[name="quantity"]').val(beefData.quantity);
                $('input[name="price"]').val(beefData.price);
                $('input[name="total"]').val(beefData.price * beefData.quantity);
                $('input[name="payment"]').val(beefData.payment);
                $('input[name="due"]').val(beefData.due);
                $('input[name="phone_number"]').val(beefData.phone);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#quantity').on('input', function() {
                var quantity = $(this).val();
                var price = $('#price').val();

                var total = quantity * price;
                $('#bill').text('Total Bill : ' + total.toFixed(2));
                $('input[name="total"]').val(total);
            });

            $('#price').on('input', function() {
                var quantity = $('#quantity').val();
                var price = $(this).val();

                var payment = quantity * price;

                $('#bill').text('Total Bill : ' + payment.toFixed(2));
                $('input[name="total"]').val(payment.toFixed(2));
            });

            $('#payment').on('input', function() {
                var totalBill = $('#bill').text();
                var matchBill = totalBill.match(/\d+\.\d+/);
                var payment = $(this).val();

                var due = (matchBill) ? matchBill : $('input[name="total"]').val() - payment;

                if (due < 0) {
                    $('input[name="due"]').val('0.00');
                } else {
                    $('input[name="due"]').val(due.toFixed(2));
                }
            });
        });
    </script>
@endsection
