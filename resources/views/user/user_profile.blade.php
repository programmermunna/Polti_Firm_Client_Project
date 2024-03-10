@extends('layout.master')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Report <small>Activity report</small></h2>
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
                        
                    </div>

                    <div class="x_content">
                        <div class="col-md-3 col-sm-3  profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view" src="{{ asset('custom/logos/Untitled.png') }}"
                                        alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3>{{ auth()->user()->name }}</h3>

                            <ul class="list-unstyled user_data">
                                {{-- <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $staff->permanent_address }}, Bangladesh --}}
                                </li>

                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> {{ auth()->user()->name }} -
                                    {{ auth()->user()->role }}
                                </li>

                                <li class="m-top-xs">
                                </li>
                            </ul>

                            <button type="button" style="color:#000;" class="btn btn-success editBtn" data-toggle="modal"
                                data-target="#editProfileModal" data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                data-mobile="{{ $user->phone_number }}">
                                <i class="fa fa-edit m-right-xs"></i>
                                Edit Profile
                            </button>
                            <br />


                            <!-- end of skills -->

                        </div>
                        <div class="col-md-9 col-sm-9 ">

                            <h2>Joining At : {{ dateTimeFormat(auth()->user()->created_at) }}</h2>
                            <button type="button" class="btn btn-sm btn-primary passBtn" data-toggle="modal"
                                data-target="#passwordModal" data-id="{{ $user->id }}">
                                Update Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="demo-form2" action="{{ route('ownpass.edit') }}" method="post" enctype="multipart/form-data"
                        data-parsley-validate class="form-horizontal form-label-left">
                        @csrf

                        <input type="hidden" name="user_id" id="userId">

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="password" name="password" class="form-control ">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Re-type Password
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="password" id="conPass" name="con-pass" class="form-control ">
                            </div>
                            @error('con-pass')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button class="btn btn-primary" type="button">Cancel</button>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- Add a save changes button or any other action buttons as needed -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="demo-form2" action="{{ route('ownuser.edit') }}" method="post"
                        enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf

                        <input type="hidden" name="user_id" id="userId">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name" name="name" class="form-control ">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name" name="email" class="form-control ">
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Mobile
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name" name="phone_number" class="form-control ">
                            </div>
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button class="btn btn-primary" type="button">Cancel</button>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- Add a save changes button or any other action buttons as needed -->
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
        $(document).ready(function() {
            $('.passBtn').click(function() {
                const passData = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    email: $(this).data('email'),
                    phone_number: $(this).data('mobile'),
                };

                // Set values to form fields
                $('input[name="user_id"]').val(passData.id);
                $('input[name="name"]').val(passData.name);
                $('input[name="email"]').val(passData.email);
                $('input[name="phone_number"]').val(passData.phone_number);
                $('input[name="address"]').val(passData.address);
                $('input[name="balance"]').val(passData.balance);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.editBtn').click(function() {
                const userData = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    email: $(this).data('email'),
                    phone_number: $(this).data('mobile'),
                };

                // Set values to form fields
                $('input[name="user_id"]').val(userData.id);
                $('input[name="name"]').val(userData.name);
                $('input[name="email"]').val(userData.email);
                $('input[name="phone_number"]').val(userData.phone_number);
                $('input[name="address"]').val(userData.address);
                $('input[name="balance"]').val(userData.balance);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection
