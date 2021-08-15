@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Change Password</h2>
        </div>
        @if(session('error'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card-body">
            <form action="{{route('password.update')}}" method="post" class="form-pill">
                @csrf
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="oldpassword" class="form-control" id="current_password" placeholder="Password"> 
                    @error('oldpassword')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="confirm_password" placeholder="Password">
                    @error('password_confimation')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group"><button type="submit" class="btn btn-info">Save</button></div>
            </form>
        </div>
    </div>
</div>
@endsection