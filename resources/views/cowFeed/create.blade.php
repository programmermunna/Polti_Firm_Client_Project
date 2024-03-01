@extends('layout.master')
@section('content')
    <div class="row">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="page_header">
            <div class="page_header_menu">
                <a class="btn btn-sm btn-primary" href="{{ route('cow.feed') }}">Feed List</a>
            </div>
        </div>

        <div class="col-2"></div>
        <div class="col-8">
            <form action="{{ route('feed.store') }}" method="post">
                @csrf
                <input type="submit" value="Save Information" class="form-control btn btn-sm btn-primary">
                <div class="cow_feed">
                    <div class="cow_basic_info">
                        <div class="basic_form">
                            <h5>
                                <i class="fa-solid fa-circle-info"></i>
                                Basic Information
                            </h5>

                            <div class="d-flex justify-content-around">
                                <div class="form-group">
                                    <label for="">Select Shed</label>
                                    <select name="shed_id" id="shedId" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($sheds as $key => $shed)
                                            <option value="{{ $shed->id }}">{{ $shed->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('shed_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Select Cow</label>
                                    <select name="cow_id" id="cowId" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                    @error('cow_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date" id="feed_date" feed_date="name" class="form-control ">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group" style="padding: 5px;">
                                <label for="">Note</label>
                                <textarea name="description" class="form-control" id="" cols="30" rows="4"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="basic_form">
                            <h5>
                                <i class="fa-solid fa-circle-info"></i>
                                Feed Informations :
                            </h5>

                            <div>
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th>
                                                <input type="checkbox" id="check-all" class="flat">
                                            </th>
                                            <th class="column-title">Food Item </th>
                                            <th class="column-title">Item Qauntity </th>
                                            <th class="column-title">Unit</th>
                                            <th class="column-title">Feeding Time</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($foods as $key => $food)
                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" value="{{ $food->id }}" class="flat"
                                                        name="food_id[]">
                                                </td>
                                                <td class=" ">{{ $food->name }}</td>
                                                <td class=" ">
                                                    <input type="number" class="form-control" name="food_quantity[]">
                                                </td>
                                                <td class=" ">
                                                    <select name="unit_id[]" id="" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}">{{ $unit->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class=" ">
                                                    <input type="text" class="form-control" placeholder="Ex: 10:20 AM">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2"></div>

    </div>

    <!-- jQuery CDN from Google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('custom/js/food.js') }}"></script>
@endsection
