@extends('admin.admin_master')

@section('admin')

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add Slider</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('store.slider')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Slider Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
                            @error('title')
                            <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Slider Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                            @error('image')
                            <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                            @enderror
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

@endsection