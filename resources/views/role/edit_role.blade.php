@extends('layout.master')
@section('content')
    <div class="row">
        <div class="page_header">
            <div class="page_header_menu">
                <a class="btn btn-sm btn-primary" href="{{ route('role.list') }}">Role List</a>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 ">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="x_panel">
                <div class="x_title">
                    <h2>Role Edit</h2>

                    
                </div>

                <div class="x_content">
                    <br />
                    <form action="{{ route('role.update') }}" method="post" enctype="multipart/form-data"
                        data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        <input type="hidden" value="{{ $role->id }}" name="role_id">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Role Name <span
                                    class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name" value="{{ $role->name }}" name="name"
                                    class="form-control ">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">ব্রাঞ্চের ইমেইল
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                @foreach ($permissions as $permission)
                                    <input type="checkbox" id="last-name" value="{{ $permission->id }}" name="permissions[]"
                                        @if (in_array($permission->id, $data)) checked @endif>
                                    {{ $permission->name }}
                                @endforeach
                            </div>
                            @error('permissions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button class="btn btn-primary" type="button">Cancel</button>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
