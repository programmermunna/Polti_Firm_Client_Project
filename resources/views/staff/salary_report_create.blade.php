@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-6">
            <form action="{{ route('salary.report_view') }}" method="post">
                @csrf
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Date<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="month" id="" class="form-control">
                            @for ($i = 1; $i <= 12; $i++)
                                @php
                                    $monthName = DateTime::createFromFormat('!m', $i)->format('F');
                                @endphp
                                <option value="{{ $i }}">{{ $monthName }}</option>
                            @endfor
                        </select>
                    </div>
                    @error('month')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Date<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
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
                    </div>
                    @error('year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="ln_solid">
                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <button type='submit' class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection