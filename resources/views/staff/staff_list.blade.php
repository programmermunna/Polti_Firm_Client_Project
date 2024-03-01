@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">

            <div class="page_header">
                <div class="page_header_menu">
                    <a class="btn btn-sm btn-primary" href="{{ route('staff.us') }}">Add Staff</a>
                </div>
            </div>

            @if (session('message'))
                <div class="alert alert-success" id="sessionMessage">
                    {{ session('message') }}
                </div>
            @endif

            <div class="x_panel">

                <div class="x_title">
                    <h2>Staff List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
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
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Salary</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $sl = 1;
                                        @endphp
                                        @if (count($staffs) > 0)
                                            @foreach ($staffs as $key => $staff)
                                                <tr class="list-item">
                                                    <td>{{ $sl }}</td>
                                                    <td>
                                                        <a href="{{ route('staff.view', ['id' => $staff->id]) }}">
                                                            {{ ucfirst($staff->name) }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <img class="staff-image" src="{{ asset('images/staffs/' . $staff->staff_image) }}" alt="">
                                                    </td>
                                                    <td>{{ number_format($staff->salary, 2) }}</td>
                                                    <td>{{ $staff->present_address }}</td>
                                                    <td>{{ $staff->email }}</td>
                                                    <td>{{ ucfirst($staff->gender) }}</td>
                                                    <td>
                                                        @if ($staff->status == '1')
                                                            Active
                                                        @else
                                                            Deactive
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('staff.edit', ['id' => $staff->id]) }}" class="btn btn-sm btn-primary">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-danger deleteButton" data-id="{{ $staff->id }}">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @php
                                                    $sl++;
                                                @endphp
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
        $(document).ready(function(){
            $('.editBtn').click(function(){
                const categoryData = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    status: $(this).data('status'),
                };

                // Set values to form fields
                $('input[name="category_id"]').val(categoryData.id);
                $('input[name="name"]').val(categoryData.name);
                $('select[name="status"]').val(categoryData.status);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection