@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="py-12">
        <div class="container">
            <div class="row">
            <h4>Home About</h4>
            <a href="{{route('add.about')}}" class="btn btn-info">Add About</a>
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
                            All About
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:5%;">SL</th>
                                        <th scope="col" style="width:10%;">Title</th>
                                        <th scope="col" style="width:20%;">Short Dis</th>
                                        <th scope="col" style="width:30%;">Long Dis</th>
                                        <th scope="col" style="width:10%;">Created At</th>
                                        <th scope="col" style="width:15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($abouts as $about)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{$about->title}}</td>
                                        <td>{{$about->short_dis}}</td>
                                        <td>{{$about->long_dis}}</td>
                                        <td>
                                            @if($about->created_at == NULL)
                                            <span class="text text-danger">No Date At</span>
                                            @else
                                            {{Carbon\Carbon::parse($about->created_at)->diffForHumans()}} <!--diffForHumans : tính giờ tạo đến now -->
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('edit/about/'.$about->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{url('delete/about/'.$about->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete');">Delete</a>
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