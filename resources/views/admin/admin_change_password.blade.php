@extends('admin.layouts.admin_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Change Password</h4>
                        @if (count($errors))
                            @foreach ($errors->all() as $error)
                                <p class="alert alert-danger alert-dismissible fade show">{{ $error }}</p>
                            @endforeach
                        @endif
                        <form action="{{ route('admin.update-password') }}" method="post">@csrf
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Old Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="old_password"  id="old_password">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="new_password" id="new_password">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>
                        <!-- end row -->
                        <!-- end row -->
                        <button class="btn btn-info">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection