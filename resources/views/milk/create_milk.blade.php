@extends('layout.master')
@section('content')

    <div style="display: none;" class="successMsg">
        <div>
            <span id="msgCross"> &times;</span>
            <h2>Data Saved</h2>
        </div>
    </div>

    <div class="page_header">
        <div class="page_header_menu">
            <a class="btn btn-sm btn-primary" href="{{ route('milk.list') }}">Milk List</a>
        </div>
    </div>

    <div class="container mt-5">
        <h2 style="color: #000; font-weight:bold;" class="mb-4">Daily Milk Store</h2>

        <h2 id="demo" style="display: none; color:darkblue; font-weight:bold;">The Time is now</h2>

        <form  method="post">

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="date" class="form-control" name="milk_date">
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tag</th>
                        <th>Daily Milk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cows as $key => $cow)
                        <tr>
                            <td>{{ $cow->tag }}</td>

                            <td>
                                <input type="number" class="form-control quantity" data-cow-id="{{ $cow->id }}" name="quantity" placeholder="Enter ltr">
                                <span style="color: red; font-weight:bold;" class="errorMsg"></span>
                            </td>

                            <td>
                                <span class="status"></span>
                                <button type="button" data-id="{{ $cow->id }}" class="btn btn-primary addBtn">Add</button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function(){
            $('.addBtn').click(function(){
                var id = $(this).data('id');
                var date = $('input[name="milk_date"]').val();
                var quantity = $(this).closest('tr').find('.quantity').val();

                var btnClicked = $(this);

                if(id > 0){
                    $.ajax({
                        url: '/cow/milk/store/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Add CSRF token for Laravel
                            date: date,
                            quantity: quantity,
                        },
                        success: function(response){
                            console.log(response);
                            if(response.message && response.status == 'error'){
                                Swal.fire({
                                    title: response.message,
                                    text: "Next Available in one hour!",
                                    icon: response.status
                                });
                            }else{
                                Swal.fire({
                                    title: response.message,
                                    text: "Congrats!",
                                    icon: response.status
                                });
                            }
                        },
                        error: function(error){
                            console.log(error);

                            if (error.responseJSON && error.responseJSON.errors) {
                                // Loop through the error messages and display them for the corresponding row
                                $.each(error.responseJSON.errors, function(key, value){
                                    btnClicked.closest('tr').find('.errorMsg').text(value[0]).show();
                                });
                            } else {
                                btnClicked.closest('tr').find('.errorMsg').text('An error occurred while storing milk. Please try again.').show();
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
