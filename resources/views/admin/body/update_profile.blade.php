@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>User Profile Update</h2>
        </div>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card-body">
            <form action="{{route('update.user.profile')}}" method="post" class="form-pill">
                @csrf
                <div class="form-group">
                    <label for="username">UserName</label>
                    <input type="text" name="name" value="{{$user['name']}}" class="form-control" id="username" > 
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{$user['email']}}" class="form-control" id="email" > 
                </div>
                
                <div class="form-group"><button type="submit" class="btn btn-info">Save</button></div>
            </form>
        </div>
    </div>
</div>
@endsection