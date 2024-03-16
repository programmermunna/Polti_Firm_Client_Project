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
                    <h2 class="list_title">পোল্টি বিক্রয় তালিকা</h2>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-sm btn-primary" href="{{ route('polti.list') }}">বাচ্চার তালিকা</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('category.list') }}">ধরন</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('shed.list') }}">শেড কালার</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('buyer.list') }}">ক্রেতা</a>
                    </div>
                </div>
                <div class="x_content">
                    <form class="" action="{{ route('routine.store') }}" method="post" novalidate>
                        @csrf   
                        <input name="ref" type="hidden" value="secret">
                        <span class="section">বাচ্চার তথ্য</span>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">রুটিন টাইটেল<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="title" type="text" placeholder="শিরোনাম"/>
                            </div>
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">খাবারের তালিকা<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select name="food" id="" multiple class="form-control">
                                    <option value="" selected disabled>select</option>
                                    @foreach ($data['foods'] as $food)
                                        <option value="{{ $food->id }}">{{ $food->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('food')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">খাবারের পিরিওড (দিন)<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="food_period" type="number" placeholder="প্রতি সপ্তাহে"/>
                            </div>
                            @error('food_period')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ভ্যাক্সিন তালিকা<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select name="vaccine" id="" multiple class="form-control">
                                    <option value="" selected disabled>select</option>
                                    @foreach ($data['vaccines'] as $vaccine)
                                        <option value="{{ $vaccine->id }}">{{ $vaccine->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('vaccine')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">ভ্যাক্সিন পিরিওড (দিন)<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" name="vaccine_period" type="number" placeholder="প্রতি সপ্তাহে"/>
                            </div>
                            @error('vaccine_period')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">বিবরণ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <textarea class="form-control" name='description' placeholder="বিস্তারিত বিবরন"></textarea>
                            </div>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">তারিখ<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" class='date' type="date" name="date">
                            </div>
                            @error('buy_date')
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

    <script src="{{ asset('asset/vendors/validator/validator.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('asset/vendors/validator/multifield.js') }}"></script>

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
@endsection
