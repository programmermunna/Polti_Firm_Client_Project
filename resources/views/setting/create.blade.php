@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            {{-- <div class="page_header">
                <div class="page_header_menu">
                    <a class="btn btn-sm btn-primary" href="{{ route('semen.list') }}">Semen List</a>
                </div>
            </div> --}}

            <div class="x_panel">
                <div class="x_content">

                    <span class="section">Setting Info</span>

                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_content">

                                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="false">Logo</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">

                                        <form action="{{ route('project.home') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">Project Name</label>
                                                <input type="text" name="project_name" value="{{ $settings->project_name }}" class="form-control">
                                                @error('project_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Project Title</label>
                                                <input type="text" name="project_title" value="{{ $settings->project_title }}" class="form-control">
                                                @error('project_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Project Title</label>
                                                <input type="text" name="project_phone" value="{{ $settings->project_phone }}" class="form-control">
                                                @error('project_phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Project Title</label>
                                                <input type="text" name="project_email" value="{{ $settings->project_email }}" class="form-control">
                                                @error('project_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="">Project Title</label>
                                                <input type="text" name="project_address" value="{{ $settings->project_address }}" class="form-control">
                                                @error('project_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                        </form>

                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <form action="{{ route('project.logo') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <img style="width: 200px" src="{{ asset("custom/logos/")."/".$settings->project_logo }}" alt="Website Logo">
                                                <br><br>
                                                <label for="">Update Project Logo</label>
                                                <input type="file" name="project_logo" class="form-control">
                                                @error('project_logo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('asset/vendors/validator/validator.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('asset/vendors/validator/multifield.js') }}"></script>
@endsection
