@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">

            <div class="page_header">
                <div class="page_header_menu">
                    <a class="btn btn-sm btn-primary" href="{{ route('polti.create') }}">Add polti</a>
                </div>
            </div>

            @if (session('message'))
                <div class="alert alert-success" id="sessionMessage">
                    {{ session('message') }}
                </div>
            @endif

            <div class="x_panel">

                <div class="x_title">
                    <h2 class="list_title">polti List</h2>
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
                                            <th>Tag</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Transport</th>
                                            <th>Hasil</th>
                                            <th>Total</th>
                                            <th>Caste</th>
                                            <th>Weight</th>
                                            <th>Buy date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>

                                        @if (count($poltis) > 0)
                                            @foreach ($poltis as $key => $polti)
                                                <tr class="list-item">
                                                    <td>{{ $polti->branch->branch_name }}</td>
                                                    <td style="color:#000; font-weight:bold;">{{ $polti->tag }}</td>
                                                    <td style="color:#000; font-weight:bold;">{{ $polti->category->name }}
                                                    </td>
                                                    <td>{{ number_format($polti->price, 2) }}</td>
                                                    <td>{{ number_format($polti->transport, 2) }}</td>
                                                    <td>{{ number_format($polti->hasil, 2) }}</td>
                                                    <td>{{ number_format($polti->total, 2) }}</td>
                                                    <td>{{ ucfirst($polti->caste) }}</td>
                                                    <td>{{ $polti->weight . ' kg' }}</td>
                                                    <td>{{ $polti->buy_date }}</td>
                                                    <td>
                                                        @if ($polti->flag == '1')
                                                            <label for="" class="btn btn-sm btn-warning">
                                                                Sold
                                                            </label>
                                                        @else
                                                            <label for="" class="btn btn-sm btn-primary">
                                                                Stock
                                                            </label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary editBtn" data-toggle="modal"
                                                            data-target="#myModal" data-id="{{ $polti->id }}"
                                                            data-tag="{{ $polti->tag }}"
                                                            data-category_id="{{ $polti->category_id }}"
                                                            data-hasil="{{ $polti->hasil }}"
                                                            data-color="{{ $polti->color }}"
                                                            data-age="{{ $polti->age }}"
                                                            data-description="{{ $polti->description }}"
                                                            data-caste="{{ $polti->caste }}"
                                                            data-weight="{{ $polti->weight }}"
                                                            data-transport="{{ $polti->transport }}"
                                                            data-price="{{ $polti->price }}"
                                                            data-type="{{ $polti->type }}"
                                                            data-buy_date="{{ $polti->buy_date }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger deleteButton"
                                                            data-id="{{ $polti->id }}">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                        <a href="" class="btn btn-sm btn-warning deleteButton"
                                                            data-id="{{ $polti->id }}">
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

                    <form class="" action="{{ route('polti.edit') }}" method="post" novalidate>
                        @csrf
                        <input type="hidden" name="polti_id">

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">দাম<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="price" required="required" />
                            </div>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ধরণ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select name="category_id" id="" class="form-control">
                                    <option value="" selected disabled>select</option>
                                    @foreach ($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">গরুর ট্যাগ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" class='optional' name="tag"
                                    data-validate-length-range="5,15" type="text" />
                            </div>
                            @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">গরুর জাত<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="caste" class='email' required="required"
                                    type="text" />
                            </div>
                            @error('caste')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">গরুর ওজন<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" class='email' name="weight"
                                    data-validate-linked='email' required='required' />
                            </div>
                            @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">পরিবহন খরচ <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" class='number' name="transport"
                                    data-validate-minmax="10" required='required'>
                            </div>
                            @error('transport')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">হাসিল <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" class='number' name="hasil"
                                    data-validate-minmax="10" required='required'>
                            </div>
                            @error('hasil')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">গরুর রঙ <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="text" class='number' name="color"
                                    data-validate-minmax="10" required='required'>
                            </div>
                            @error('color')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রয় তারিখ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" class='date' type="date" name="buy_date"
                                    required='required'>
                            </div>
                            @error('buy_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">গরুর বয়স<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="age" class='email' required="required"
                                    type="text" />
                            </div>
                            @error('age')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">বিবরণ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <textarea class="form-control" name='description'></textarea>
                            </div>
                            @error('description')
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
                var poltiId = $(this).data('id');
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
                            url: '/polti/delete/' + poltiId,
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
                const poltiData = {
                    id: $(this).data('id'),
                    price: $(this).data('price'),
                    categoryId: $(this).data('category_id'),
                    tag: $(this).data('tag'),
                    caste: $(this).data('caste'),
                    weight: $(this).data('weight'),
                    transport: $(this).data('transport'),
                    hasil: $(this).data('hasil'),
                    color: $(this).data('color'),
                    buy_date: $(this).data('buy_date'),
                    age: $(this).data('age'),
                    description: $(this).data('description')
                };

                // Set values to form fields
                $('input[name="polti_id"]').val(poltiData.id);
                $('input[name="price"]').val(poltiData.price);
                $('select[name="category_id"]').val(poltiData.categoryId);
                $('input[name="tag"]').val(poltiData.tag);
                $('input[name="caste"]').val(poltiData.caste);
                $('input[name="weight"]').val(poltiData.weight);
                $('input[name="transport"]').val(poltiData.transport);
                $('input[name="hasil"]').val(poltiData.hasil);
                $('input[name="color"]').val(poltiData.color);
                $('input[name="buy_date"]').val(poltiData.buy_date);
                $('input[name="age"]').val(poltiData.age);
                $('textarea[name="description"]').val(poltiData.description);

                // Open the modal
                $('#myModal').modal('show');
            });
        });
    </script>
@endsection
