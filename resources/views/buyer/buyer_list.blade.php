@extends('layout.master')
@section('content')
  <div class="row">
      <div class="col-md-12 col-sm-12 ">

        <div class="page_header">
            <div class="page_header_menu">
                <a class="btn btn-sm btn-primary" href="{{ route('buyer.us') }}">Add Buyer</a>
            </div>
        </div>

        @if (session('message'))
            <div class="alert alert-success" id="sessionMessage">
                {{ session('message') }}
            </div>
        @endif

        <div class="x_panel">
                <div class="x_title">
                <h2>ক্রেতা তালিকা</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>

                                @if (count($buyers) > 0)
                                    @foreach ($buyers as $key => $buyer)
                                        <tr class="list-item">
                                            <td>{{ $buyer->name }}</td>
                                            <td>{{ $buyer->branch->branch_name }}</td>
                                            <td>{{ $buyer->phone_number }}</td>
                                            <td>{{ ucfirst($buyer->address) }}</td>
                                            <td>{{ number_format($buyer->balance, 2) . ' TK' }}</td>
                                            <td>
                                                @if ($buyer->status == 1)
                                                    Active
                                                @else
                                                    Deactive
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary editBtn" data-toggle="modal"
                                                    data-target="#myModal" data-id="{{ $buyer->id }}"
                                                    data-name="{{ $buyer->name }}" data-phone_number="{{ $buyer->phone_number }}"
                                                    data-address="{{ $buyer->address }}" data-balance="{{ $buyer->balance }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger deleteButton" data-id="{{ $buyer->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
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

                <form class="" action="{{ route('buyer.edit') }}" method="post" novalidate>
                    @csrf
                    <span class="section">ক্রেতা তথ্য</span>

                    <input type="hidden" name="buyer_id">

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রেতার নাম<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="name" type="text" required="required" />
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">ফোন নাম্বার<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="phone_number" class='email' required="required" type="text" />
                        </div>
                        @error('phone_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রেতার ঠিকানা<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" class='email' name="address" data-validate-linked='email' required='required' />
                        </div>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রেতার ব্যালেন্স <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="number" class='number' name="balance" data-validate-minmax="10" required='required'>
                        </div>
                        @error('balance')
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
                var buyerId = $(this).data('id');
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
                            url: '/buyer/delete/' + buyerId,
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
        $(document).ready(function(){
            $('.editBtn').click(function(){
            const buyerData = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    phone_number: $(this).data('phone_number'),
                    address: $(this).data('address'),
                    balance: $(this).data('balance'),
                };

                // Set values to form fields
                $('input[name="buyer_id"]').val(buyerData.id);
                $('input[name="name"]').val(buyerData.name);
                $('input[name="phone_number"]').val(buyerData.phone_number);
                $('input[name="address"]').val(buyerData.address);
                $('input[name="balance"]').val(buyerData.balance);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection