@extends('layout.master')
@section('content')
    <div class="row">
        <form style="width: 100%" action="{{ route('show.employee_salary_report') }}" method="post">
            @csrf
            <div class="d-flex">
                <div class="col-3">
                    <label for="">Start Month</label>
                    <select name="month" id="" class="form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $monthName = DateTime::createFromFormat('!m', $i)->format('F');
                            @endphp
                            <option value="{{ $i }}">{{ $monthName }}</option>
                        @endfor
                    </select>
                    @error('month')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-3">
                    <label for="">Select Year</label>
                    <select name="year" id="year" class="form-control">
                        @php
                            $currentYear = date('Y');
                            $startYear = 2018;
                            $endYear = $currentYear + 5;
                        @endphp

                        @for ($year = $startYear; $year <= $endYear; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                    @error('year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="">Select Employee</label>
                    <select name="staff_id" id="staff_id" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach ($staffs as $key => $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    </select>
                    @error('staff_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="">Search</label>
                    <input type="submit" value="Search" class="form-control btn btn-sm btn-primary">
                </div>
            </div>
        </form>
    </div>
@endsection
