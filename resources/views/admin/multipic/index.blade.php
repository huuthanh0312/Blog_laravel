@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-group">
                        @foreach($images as $multi)
                        <div class="col-md-4 mt-5">
                            <div class="card">
                                <img src="{{ asset($multi->image)}}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Multi Image</div>
                        <div class="card-body">
                            <form action="{{route('store.multi')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand_image">Multi Image</label>
                                    <input type="file" name="image[]" class="form-control" id="brand_image" multiple>
                                    @error('brand_image')
                                    <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add Image</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection