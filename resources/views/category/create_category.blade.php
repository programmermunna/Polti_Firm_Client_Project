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
                <h2 class="list_title">ধরন</h2>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-sm btn-primary" href="{{ route('category.list') }}">ধরন তালিকা</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('polti.create') }}">বাচ্চা যুক্ত</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('shed.list') }}">শেড কালার</a>
                    <a class="btn btn-sm btn-primary" href="{{ route('buyer.list') }}">ক্রেতা</a>
                </div>
            </div>


            <div class="x_content">

                <form class="" action="{{ route('category.store') }}" method="post" novalidate>
                    @csrf
                    <span class="section">ধরন তথ্য</span>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="name" type="text" required="required" />
                        </div>
                        @error('name')
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
		function hideshow(){
			var password = document.getElementById("password1");
			var slash = document.getElementById("slash");
			var eye = document.getElementById("eye");

			if(password.type === 'password'){
				password.type = "text";
				slash.style.display = "block";
				eye.style.display = "none";
			}
			else{
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