@extends('layout.master')
@section('content')

    <div style="display: none;" class="successMsg">
        <div>
            <span id="msgCross"> &times;</span>
            <h2>Data Saved</h2>
        </div>
    </div>

    <div class="container mt-5">
        <h2 style="color: #000; font-weight:bold;" class="mb-4">বেতন আপডেট</h2>

        <h2 id="demo" style="display: none; color:darkblue; font-weight:bold;">The Time is now</h2>

        <form  method="post">

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="date" class="form-control" name="salary_date" name="date">
                        <span style="color: red; font-weight:bold;" id="errorMsg"></span>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff Name</th>
                        <th>Image</th>
                        <th>Basic Salary</th>
                        <th>Month Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $key => $staff)
                        <tr>
                            <td>{{ $staff->name }}</td>
                            <td>
                                <img style="width: 50px;height:50px;" src="{{ asset('images/staffs/' . $staff->staff_image) }}" alt="">
                            </td>

                            @if ($staff->flag == '1')
                                <td>
                                    <input name="basic_salary" class="basic" data-basic-salary="{{ $staff->salary }}" style="border:none; background:transparent;" type="text" value="{{ $staff->salary }}" readonly>
                                </td>
                                <td>
                                    <input type="number" class="form-control salary" data-staff-id="{{ $staff->id }}" name="salary" placeholder="Enter salary">
                                    <span class="error-message" style="color: red; display: none;">You've entered a salary over the basic amount.</span>
                                    <span style="color: red; font-weight:bold;" class="errorMsg"></span>
                                </td>
                                <td>
                                    <button type="button" disabled class="btn btn-success">Paid</button>
                                </td>
                            @else
                                <td>
                                    <input name="basic_salary" class="basic" data-basic-salary="{{ $staff->salary }}" style="border:none; background:transparent;" type="text" value="{{ $staff->salary }}" readonly>
                                </td>
                                <td>
                                    <input type="number" class="form-control salary" data-staff-id="{{ $staff->id }}" name="salary" placeholder="Enter salary">
                                    <span class="error-message" style="color: red; display: none;">You've entered a salary over the basic amount.</span>
                                    <span style="color: red; font-weight:bold;" class="errorMsg"></span>
                                </td>
                                <td>
                                    <button type="button" data-id="{{ $staff->id }}" class="btn btn-primary">Add</button>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.salary').on('input', function(){
                let enteredSalary = parseFloat($(this).val());
                let basicSalary = parseFloat($(this).closest('tr').find('.basic').data('basic-salary'));

                if (enteredSalary > basicSalary) {
                    $(this).next('.error-message').show();
                } else {
                    $(this).next('.error-message').hide();
                }
            });

            $('.btn-primary').click(function(){
                var id = $(this).data('id');
                var date = $('input[name="salary_date"]').val();
                var salary = $(this).closest('tr').find('.salary').val();
                var basicSalary = $(this).closest('tr').find('.basic').data('basic-salary');

                var formatDate = new Date(date);
                var month      = formatDate.getMonth() + 1;
                var year       = formatDate.getFullYear();

                if(id > 0){
                    $.ajax({
                        url: '/staff/salary/add/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
                            salary: salary,
                            basic_salary: basicSalary,
                            salary_date: date,
                            month: month,
                            year: year,
                        },
                        success: function(response){
                            if(response.message){
                                $('.successMsg').find('h2').text(response.message);
                                $('.successMsg').show();
                            }
                        },
                        error: function(error){
                            console.log(error);
                            // Handle error here
                            if (error.responseJSON && error.responseJSON.message) {
                                // Display error message in the view
                                // $(this).closest('tr').find('.error-message').text(error.responseJSON.message).show();
                                $('#errorMsg').text(error.responseJSON.message);
                            }
                        }
                    });
                }else{
                    alert('Your Selectd button have no id!');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                // Your function logic here
                var d = new Date();

                var month = d.getMonth()+1;
                var day = d.getDate();

                var output = d.getFullYear() + '/' +
                    (month<10 ? '0' : '') + month + '/' +
                    (day<10 ? '0' : '') + day;

                $('#demo').text('Today : ' + output);
                $('#demo').show();
            }, 5000); // 60,000 milliseconds = 1 minute

            $('#msgCross').click(function(){
                $('.successMsg').hide();
                location.reload();
            });
        });
    </script>

@endsection
