@extends('layout.master')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="page_header">
            <div class="page_header_menu">
                <a class="btn btn-sm btn-primary" href="{{ route('milk.sell_list') }}">Milk Sell List</a>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <h2>Milk Sell for <small style="font-weight: bold;color:#000;">Branch : {{ session('branch_id') }}</small></h2>
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
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <form class="" action="{{ route('milk.sell_store') }}" method="post" novalidate>
                    @csrf
                    {{-- <span class="section">
                        <h4 style="font-weight: bold; color:#000;">Today Beef : {{ $totalBeef . ' Kg'}}</h4>
                    </span> --}}

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Milk<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="milk_date" class="form-control" id="" required="required">
                                <option value="">select</option>
                                @foreach ($milks as $key => $milk)
                                    <option value="{{ $milk->milk_date }}">{{ dateTimeFormat($milk->milk_date) . ' : ' .$milk->total_quantity . ' Ltr' }}</option>
                                @endforeach
                            </select>
                            <div class="milk_info_block">
                                <h5>Milk Information</h5>
                                <h6>
                                    <b></b>
                                </h6>
                            </div>
                        </div>
                        @error('milk_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">কাস্টমারের নাম<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="name" type="text" required="required" />
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">তারিখ<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="sale_date" type="date" required="required" />
                        </div>
                        @error('sale_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">দুধের পরিমাণ<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" id="quantity" name="quantity" placeholder="in ltr*" type="text" required="required" />
                        </div>
                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">মূল্য<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" id="price" name="price" placeholder="per ltr*" type="text" required="required" />
                            <p id="bill" style="margin-bottom: 0; color:darkblue; font-weight:bold;"></p>
                        </div>
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">পেমেন্ট<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" id="payment" name="payment" type="text" required="required" />
                        </div>
                        @error('payment')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">বাকি<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="due" type="text" required="required" />
                        </div>
                        @error('due')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">কাস্টমারের ফোন<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" name="phone_number" type="text" placeholder="+880" required="required" />
                        </div>
                        @error('phone_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary">Sell</button>
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
        $(document).ready(function(){
            $('select[name="milk_date"]').on('change', function(){
                var selectDate = $(this).val();

                if(selectDate){
                    $.ajax({
                        url: '/get/milk/info/' + selectDate,
                        type: 'GET',
                        success: function(response){
                            $('.milk_info_block').find('b').text('Stock : ' + response);
                            $('.milk_info_block').show();
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#price').on('input', function(){
                var quantity = $('#quantity').val();
                var price = $(this).val();

                var payment = quantity * price;

                $('#bill').text('Total Bill : ' + payment.toFixed(2));
            });

            $('#payment').on('input', function(){
                var totalBill = $('#bill').text();
                var matchBill = totalBill.match(/\d+\.\d+/);
                var payment = $(this).val();

                var due = matchBill - payment;

                if(due < 0){
                    $('input[name="due"]').val('0.00');
                }else{
                    $('input[name="due"]').val(due.toFixed(2));
                }
            });
        });
    </script>

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