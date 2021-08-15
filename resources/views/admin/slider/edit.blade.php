@extends('admin.admin_master')

@section('admin')
<div class="content">
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
                        <div class="card-header">Edit Slider</div>
                        <div class="card-body">
                            <form action="{{url('update/slider/'.$sliders->id)}}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$sliders->image}}">
                                <div class="form-group">
                                    <label for="title">Slider Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        placeholder="Enter title" value="{{$sliders->title}}">
                                    @error('title')
                                    <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Slider Description</label>
                                    <textarea class="form-control" name="description"
                                        id="description" rows="4">{{$sliders->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control-file" id="image">
                                    @error('image')
                                    <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="from-group">
                                    <img src="{{asset($sliders->image)}}" alt="" style="width:400px; height:200px;">
                                </div>
                                <br>
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
</div>

@endsection
