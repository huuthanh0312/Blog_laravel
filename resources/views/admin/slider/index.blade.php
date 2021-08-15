@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="py-12">
        <div class="container">
            <div class="row">
            <h4>Home Slider</h4>
            <a href="{{route('add.slider')}}" class="btn btn-info">Add Slider</a>
                <div class="col-md-12">
                    <div class="card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="card-header">
                            All Slider
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:5%;">SL No</th>
                                        <th scope="col" style="width:15%;">Title</th>
                                        <th scope="col" style="width:35%;">Description</th>
                                        <th scope="col" style="width:5%;">Image</th>
                                        <th scope="col" style="width:5%;">Created At</th>
                                        <th scope="col" style="width:15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{$slider->title}}</td>
                                        <td>{{$slider->description}}</td>
                                        <td><img src="{{asset($slider->image)}}" width="40px;" height="70px;"></td>
                                        <td>
                                            @if($slider->created_at == NULL)
                                            <span class="text text-danger">No Date At</span>
                                            @else
                                            {{Carbon\Carbon::parse($slider->created_at)->diffForHumans()}} <!--diffForHumans : tính giờ tạo đến now -->
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('edit/slider/'.$slider->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{url('delete/slider/'.$slider->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete');">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection