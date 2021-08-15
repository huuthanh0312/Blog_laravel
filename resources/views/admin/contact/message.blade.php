@extends('admin.admin_master')

@section('admin')
<div class="content">
    <div class="py-12">
        <div class="container">
            <div class="row">
            <h4>Home Slider</h4>
            <a href="{{route('add.contact')}}" class="btn btn-info">Add Contact</a>
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
                            All Contact
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL No</th>
                                        <th scope="col">Contact Name</th>
                                        <th scope="col">Contact Email</th>
                                        <th scope="col">Contact Subject</th>
                                        <th scope="col">Contact Message</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- @php($i = 1) -->
                                    @foreach($contacts_message as $message)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{$message->name}}</td>
                                        <td>{{$message->email}}</td>
                                        <td>{{$message->subject}}</td>
                                        <td>{{$message->message}}</td>
                                        <td>
                                            @if($message->created_at == NULL)
                                            <span class="text text-danger">No Date At</span>
                                            @else
                                            {{Carbon\Carbon::parse($message->created_at)->diffForHumans()}} <!--diffForHumans : tính giờ tạo đến now -->
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('admin/edit/contact/'.$message->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{url('admin/delete/contact/'.$message->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete');">Delete</a>
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