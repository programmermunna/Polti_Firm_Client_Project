@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">

            <div class="page_header">
                <div class="page_header_menu">
                    <a class="btn btn-sm btn-primary" href="{{ route('branch.create') }}">Add Branch</a>
                </div>
            </div>

            @if (session('message'))
                <div class="alert alert-success" id="sessionMessage">
                    {{ session('message') }}
                </div>
            @endif

            <div class="x_panel">

                <div class="x_title">
                    <h2 style="color:#000; font-weight:bold;">ব্রাঞ্চ তালিকা</h2>
                    
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @if (count($branches) > 0)
                                            @foreach ($branches as $key => $branch)
                                                <tr class="list-item">
                                                    <td>{{ ucfirst($branch->branch_name) }}</td>
                                                    <td>
                                                        @if ($branch->status == '1')
                                                            Active
                                                        @else
                                                            Deactive
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary editBtn" data-toggle="modal" data-target="#myModal"
                                                        data-id="{{ $branch->id }}" data-name="{{ $branch->branch_name }}" data-status="{{ $branch->status }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger deleteButton" data-id="{{ $branch->id }}">
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

                <form class="" action="{{ route('branch.edit') }}" method="post" novalidate>
                    @csrf
                    <input type="hidden" name="branch_id">

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="branch_name" type="text" required="required" />
                        </div>
                        @error('branch_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Status<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="status" id="" class="form-control">
                                <option value="" selected disabled>select</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
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
                var branchId = $(this).data('id');
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
                            url: '/branch/delete/' + branchId,
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
                const branchData = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    status: $(this).data('status'),
                };

                // Set values to form fields
                $('input[name="branch_id"]').val(branchData.id);
                $('input[name="branch_name"]').val(branchData.name);
                $('select[name="status"]').val(branchData.status);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection