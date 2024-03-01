@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">

            <div class="page_header">
                <div class="page_header_menu">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">
                        Create New
                    </button>
                </div>
            </div>

            @if (session('message'))
                <div class="alert alert-success" id="sessionMessage">
                    {{ session('message') }}
                </div>
            @endif

            <div class="x_panel">

                <div class="x_title">
                    <h2 style="font-weight: bold; color:#000;">Vaccines</h2>
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
                                            <th>#</th>
                                            <th>Vaccine Name</th>
                                            <th>Period(Days)</th>
                                            <th>Reapet Vaccine</th>
                                            <th>Dose</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @if (count($vaccines) > 0)
                                            @php
                                                $sl = 1;
                                            @endphp
                                            @foreach ($vaccines as $key => $vaccine)
                                                <tr class="list-item">
                                                    <td>
                                                        <label for="" class="btn btn-sm btn-success">
                                                            {{ $sl }}
                                                        </label>
                                                    </td>
                                                    <td>{{ ucfirst($vaccine->name) }}</td>
                                                    <td>{{ $vaccine->period_days }}</td>
                                                    <td>
                                                        @if ($vaccine->repeat_vaccine == 'yes')
                                                            <label for="" class="btn btn-sm btn-primary">
                                                                {{ ucfirst($vaccine->repeat_vaccine) }}
                                                            </label>
                                                        @else
                                                            <label for="" class="btn btn-sm btn-danger">
                                                                {{ ucfirst($vaccine->repeat_vaccine) }}
                                                            </label>
                                                        @endif
                                                    </td>
                                                    <td>{{ $vaccine->dose_qty }}</td>
                                                    <td>{{ $vaccine->note }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary editBtn" data-toggle="modal"
                                                            data-target="#myModal" data-id="{{ $vaccine->id }}"
                                                            data-name="{{ $vaccine->name }}"
                                                            data-period_days="{{ $vaccine->period_days }}"
                                                            data-repeat_vaccine="{{ $vaccine->repeat_vaccine }}"
                                                            data-dose_qty="{{ $vaccine->dose_qty }}"
                                                            data-note="{{ $vaccine->note }}"
                                                            data-status="{{ $vaccine->status }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger deleteButton"
                                                            data-id="{{ $vaccine->id }}">
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

    <!-- Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Edit Vaccine</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form class="" action="{{ route('vaccine.edit') }}" method="post" novalidate>
                        @csrf
                        <span class="section">Cost Info</span>
                        <input type="hidden" name="vaccine_id">
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Vaccine Name
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="name" name="name" placeholder="Name" type="text"
                                    required="required" />
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Period(Days)
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="period_day" id="period_day" placeholder="Days"
                                    type="text" required="required" />
                            </div>
                            @error('period_day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Reapeat Vaccine
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <select name="repeat_vaccine" id="repeat_vaccine" class="form-control" id="">
                                    <option value="">Select</option>
                                    <option value="yes">yes</option>
                                    <option value="no">no</option>
                                </select>
                            </div>
                            @error('repeat_vaccine')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Dose :
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="dose_qty" id="dose_qty" placeholder="Days"
                                    type="text" required="required" />
                            </div>
                            @error('dose_qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Note
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <textarea name="note" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            @error('note')
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

    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Add New Vaccine</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form class="" action="{{ route('vaccine.store') }}" method="post" novalidate>
                        @csrf
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Vaccine Name
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="name" placeholder="Name" type="text"
                                    required="required" />
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Period(Days)
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="period_day" placeholder="Days" type="text"
                                    required="required" />
                            </div>
                            @error('period_day')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Reapeat Vaccine
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <select name="repeat_vaccine" class="form-control" id="">
                                    <option value="">Select</option>
                                    <option value="yes">yes</option>
                                    <option value="no">no</option>
                                </select>
                            </div>
                            @error('repeat_vaccine')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Dose :
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="dose_qty" placeholder="Days" type="text"
                                    required="required" />
                            </div>
                            @error('dose_qty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">
                                Note
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <textarea name="note" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <button type='submit' class="btn btn-primary">Create</button>
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
                var vaccineId = $(this).data('id');
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
                            url: '/vaccine/delete/' + vaccineId,
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
                const shedData = {
                    id: $(this).data('id'),
                    name: $(this).data('name'),
                    period_days: $(this).data('period_days'),
                    dose_qty: $(this).data('dose_qty'),
                    repeat_vaccine: $(this).data('repeat_vaccine'),
                    note: $(this).data('note'),
                    status: $(this).data('status'),
                };

                // Set values to form fields
                $('input[name="vaccine_id"]').val(shedData.id);
                $('#name').val(shedData.name);
                $('#period_day').val(shedData.period_days);
                $('#dose_qty').val(shedData.dose_qty);
                $('#repeat_vaccine').val(shedData.repeat_vaccine);
                $('textarea[name="note"]').val(shedData.note);
                $('#status').val(shedData.status);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection
