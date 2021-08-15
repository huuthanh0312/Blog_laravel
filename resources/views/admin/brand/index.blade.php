@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            All Brand
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL No</th>
                                        <th scope="col">Brand Name</th>
                                        <th scope="col">Brand Image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- @php($i = 1) -->
                                    @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                        <td>{{$brand->brand_name}}</td>
                                        <td><img src="{{asset($brand->brand_image)}}" width="40px;" height="70px;"></td>
                                        <td>
                                            @if($brand->created_at == NULL)
                                            <span class="text text-danger">No Date At</span>
                                            @else
                                            {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}} <!--diffForHumans : tính giờ tạo đến now -->
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{url('brand/delete/'.$brand->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete');">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                            {{$brands->links()}}
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form action="{{route('store.brand')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name"
                                        aria-describedby="brandHelp" placeholder="Enter Brand">
                                    @error('brand_name')
                                    <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                <div class="form-group">
                                    <label for="brand_image">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image">
                                    @error('brand_image')
                                    <small id="brandHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
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
</div>
@endsection