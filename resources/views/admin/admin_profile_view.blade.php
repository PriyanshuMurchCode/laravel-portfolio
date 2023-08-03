@extends('admin.admin_master')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <center>
                        <img class="rounded-circle avatar-xl mt-3" src="{{ (!empty($adminData->profile_image)) ? url('uploads/admin_images/'.$adminData->profile_image) : url('uploads/no_image.jpg')  }}" alt="Card image cap">
                    </center>
                    <div class="card-body">
                        <h4 class="card-title">Name : {{ $adminData->name }}</h4>
                        <p class="card-text mb-2">Email : {{ $adminData->email }}</p>
                        <p class="card-text">Username : {{ $adminData->username }}</p>
                        <hr>
                        <p class="card-text"><a href="{{ route('admin.edit-profile') }}" class="btn btn-info btn-rounded waves-effect waves-light">Edit Profile</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection