@extends('layout.master')
@section('content')
    <div class="row">
        <div class="page_header">
            <div class="page_header_menu">
                <a class="btn btn-sm btn-primary" href="{{ route('role.create') }}">Create Role</a>
            </div>
        </div>
        <div class="container mt-5 px-2">
            <div class="table-responsive">
                <table class="table table-responsive table-borderless">

                    <thead>
                        <tr class="bg-light">
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="5%">Name</th>
                            <th scope="col" width="5%">Permissions</th>
                            <th scope="col" width="5%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr class="list-item">
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary viewButton"
                                        data-id="{{ $role->id }}">
                                        View
                                    </button>
                                    <div>

                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('role.edit', ['id' => $role->id]) }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger deleteButton" data-id={{ $role->id }}>
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="permissionsModal" tabindex="-1" role="dialog" aria-labelledby="permissionsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionsModalLabel">Role Permissions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="permissionsModalBody">
                    <!-- Permissions will be displayed here -->
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('.deleteButton').click(function() {
                var roleId = $(this).data('id');
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
                            url: '/role/delete/' + roleId,
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
        $(document).ready(function() {
            $('.viewButton').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/get-permissions/' + id,
                    type: 'GET',
                    success: function(response) {
                        // Handle the response (display permissions)
                        var permissionsHtml = '<ul>';
                        $.each(response, function(index, permission) {
                            permissionsHtml += '<li>' + permission.name + '</li>';
                        });
                        permissionsHtml += '</ul>';

                        // Display permissions in a modal or specific section
                        $('#permissionsModalBody').html(permissionsHtml);
                        $('#permissionsModal').modal(
                            'show'); // Assuming you're using Bootstrap modal
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Error fetching permissions.');
                    }
                });
            });
        });
    </script>
@endsection
