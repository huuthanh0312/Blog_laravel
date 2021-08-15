@extends('admin.admin_master')

@section('admin')

<div class="py-12">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('success')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit About</div>
                    <div class="card-body">
                        <form method="post" action="{{url('update/about/'.$about->id)}}">
                            @csrf
                            <div class="form-group">
                                <label for="title">About Title</label>
                                <input type="text" name="title" value="{{$about->title}}" class="form-control" id="title"
                                    placeholder="Enter title">
                                @error('title')
                                <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Short Description</label>
                                <textarea class="form-control" name="short_dis" id="description" rows="4">{{{$about->short_dis}}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Long Description</label>
                                <textarea class="form-control" name="long_dis" id="description" rows="4">{{$about->long_dis}}</textarea>
                            </div>
                            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-default">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection