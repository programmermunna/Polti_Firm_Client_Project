@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="x_panel">
                <div class="page_header">
                    <h2 class="list_title">বিক্রয় তালিকা সমূহ</h2>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary" href="{{ route('polti_sell.list') }}">বিক্রয় তালিকা</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('polti.create') }}">বাচ্চা যুক্ত</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('category.list') }}">ধরন</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('shed.list') }}">শেড কালার</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('buyer.list') }}">ক্রেতা</a>
                    </div>
                </div>
                <div class="x_content">

                    <form class="" action="{{ route('sell.store') }}" method="post" novalidate>
                        @csrf
                        <span class="section">বিক্রয় তথ্য</span>

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
                            <label class="col-form-label col-md-3 col-sm-3  label-align">পোল্টির ধরন<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select name="category_id" id="" class="form-control">
                                    <option value="" selected disabled>select</option>
                                    @foreach ($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('caste')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">কেজি<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="kg" type="number" required="required" />
                            </div>
                            @error('kg')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">সংখ্যা<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="piece" type="number" required="required" />
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
                            <label class="col-form-label col-md-3 col-sm-3  label-align">বিবরণ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <textarea class="form-control" name='description'></textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">বিক্রয় তারিখ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" class='date' type="date" name="sell_date" required='required'>
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
                                    <button type='submit' class="btn btn-primary">Submit</button>
                                    <button type='reset' class="btn btn-success">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Buyer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form class="" action="{{ route('buyer.store') }}" method="post" novalidate>
                        @csrf
                        <span class="section">ক্রেতা তথ্য</span>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রেতার নাম<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="name" type="text" required="required" />
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ফোন নাম্বার<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="phone_number" class='email' required="required"
                                    type="text" />
                            </div>
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রেতার ঠিকানা<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="text" class='email' name="address"
                                    data-validate-linked='email' required='required' />
                            </div>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ক্রেতার ব্যালেন্স <span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="number" class='number' name="balance"
                                    data-validate-minmax="10" required='required'>
                            </div>
                            @error('balance')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <button type='submit' class="btn btn-primary">Submit</button>
                                    <button type='reset' class="btn btn-success">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <script src="{{ asset('asset/vendors/validator/validator.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('asset/vendors/validator/multifield.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />

    <script>
        // $(".chosen-select").chosen({
        //     no_results_text: "Oops, nothing found!"
        // })
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="polti_id"]').on('change', function() {
                var id = $(this).val();

                if (id != null) {
                    $.ajax({
                        url: '/get/polti/info/' + id,
                        type: 'GET',
                        success: function(response) {
                            $('select[name="polti"]').val(response
                            .id); // Assuming 'id' is the field you want to set in the dropdown
                            $('select[name="type"]').val(response.type);
                            $('input[name="tag"]').val(response.tag);
                            $('input[name="caste"]').val(response.caste);
                            $('input[name="color"]').val(response.color);
                            $('textarea[name="description"]').val(response.description);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        function hideshow() {
            var password = document.getElementById("password1");
            var slash = document.getElementById("slash");
            var eye = document.getElementById("eye");

            if (password.type === 'password') {
                password.type = "text";
                slash.style.display = "block";
                eye.style.display = "none";
            } else {
                password.type = "password";
                slash.style.display = "none";
                eye.style.display = "block";
            }

        }
    </script>

    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
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
