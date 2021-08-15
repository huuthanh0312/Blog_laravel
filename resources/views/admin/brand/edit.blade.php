@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                        <form action="{{url('brand/update/'.$brands->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$brands->brand_image}}">                      
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name"
                                        aria-describedby="brandHelp" placeholder="Enter Brand" value="{{$brands->brand_name}}">
                                    @error('brand_name')
                                    <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                <div class="form-group">
                                    <label for="brand_image">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image" >
                                    @error('brand_image')
                                    <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="from-group">
                                    <img src="{{asset($brands->brand_image)}}" alt="" style="width:400px; height:200px;">
                                </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection