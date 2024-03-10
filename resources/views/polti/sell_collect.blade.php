@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">

            @if (session('message'))
                <div class="alert alert-success" id="sessionMessage">
                    {{ session('message') }}
                </div>
            @endif

            <div class="x_panel">

                <div class="page_header">
                    <h2 class="list_title">বাকী বিক্রয় তালিকা সমূহ</h2>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary" href="{{ route('polti.sell') }}">নতুন বিক্রয়</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('polti.create') }}">বাচ্চা যুক্ত</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('category.list') }}">ধরন</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('shed.list') }}">শেড</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('buyer.list') }}">ক্রেতা</a>
                    </div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Branch</th>
                                            <th>piece</th>
                                            <th>Price</th>
                                            <th>Payment</th>
                                            <th>Due</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @if (count($dueCollect) > 0)
                                            @foreach ($dueCollect as $key => $sellDue)
                                                <tr class="list-item">
                                                    <td>{{ ucfirst($sellDue->buyer->name) }}</td>
                                                    <td>{{ ucfirst($sellDue->branch->branch_name) }}</td>
                                                    <td>{{ $sellDue->piece }}</td>
                                                    <td>{{ number_format($sellDue->price, 2) }}</td>
                                                    <td>{{ number_format($sellDue->payment, 2) }}</td>
                                                    <td style="font-weight: bold;color:red;">
                                                        {{ number_format($sellDue->due, 2) }}</td>
                                                    <td>
                                                        @if ($sellDue->status == '1')
                                                            <label for=""
                                                                class="btn btn-sm btn-warning">Booking</label>
                                                        @else
                                                            <label for=""
                                                                class="btn btn-sm btn-primary">Delivered</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary editBtn" data-toggle="modal"
                                                            data-target="#myModal" data-id="{{ $sellDue->id }}"
                                                            data-status="{{ $sellDue->status }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <a href="{{ route('sell.invoice', ['id' => $sellDue->id]) }}"
                                                            class="btn btn-sm btn-secondary">
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
                    <h4 class="modal-title">Payment Info</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form class="" action="{{ route('payment.store') }}" method="post" novalidate>
                        @csrf
                        <input type="hidden" name="sell_id">

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Amount<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="payment" type="text" required="required" />
                            </div>
                            @error('payment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary">Paid</button>
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
                var categoryId = $(this).data('id');
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
                            url: '/category/delete/' + categoryId,
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
                const sellData = {
                    id: $(this).data('id'),
                };

                // Set values to form fields
                $('input[name="sell_id"]').val(sellData.id);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection
