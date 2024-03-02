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
                <a class="btn btn-sm btn-primary" href="{{ route('vaccine.monitoring') }}">Vaccine List</a>
            </div>
        </div>

        <div class="col-2"></div>
        <div class="col-8">
            <form action="{{ route('vaccine_monitoring.store') }}" method="post">
                @csrf
                <input type="submit" value="Save Information" class="form-control btn btn-sm btn-primary">
                <div class="polti_feed">
                    <div class="polti_basic_info">
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
                                    <label for="">Select polti</label>
                                    <select name="polti_id" id="poltiId" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                    @error('polti_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="basic_form">
                            <h5>
                                <i class="fa-solid fa-circle-info"></i>
                                Vaccine Information
                            </h5>

                            <div class="p-1">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="date" name="date" class="form-control">
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Note</label>
                                    <textarea name="note" id="note" class="form-control" cols="30" rows="2"></textarea>
                                    @error('note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="basic_form">
                            <h5>
                                <i class="fa-solid fa-circle-info"></i>
                                Vaccine List :
                            </h5>

                            <div>
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th>
                                                <input type="checkbox" id="check-all" class="flat">
                                            </th>
                                            <th class="column-title">Vaccine Name </th>
                                            <th class="column-title">Dose </th>
                                            <th class="column-title">Repeat</th>
                                            <th class="column-title">Remarks</th>
                                            <th class="column-title">Given Time</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($vaccines as $key => $vaccine)
                                            <tr class="even pointer">
                                                <td class="a-center ">
                                                    <input type="checkbox" value="{{ $vaccine->id }}" class="flat"
                                                        name="vaccine_id[]">
                                                </td>
                                                <td class=" ">{{ $vaccine->name }}</td>
                                                <td class=" ">
                                                    {{ $vaccine->dose_qty }}
                                                </td>
                                                <td class=" ">
                                                    @if ($vaccine->repeat_vaccine == 'yes')
                                                        <i class="fa-solid fa-check"></i>
                                                    @else
                                                        <i class="fas fa-regular fa-circle-xmark"></i>
                                                    @endif
                                                </td>
                                                <td class=" ">
                                                    <input type="text" class="form-control" name="remarks[]">
                                                </td>
                                                <td class=" ">
                                                    <input type="text" name="given_time[]" class="form-control"
                                                        placeholder="Ex: 10:20 AM">
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
