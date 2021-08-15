<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Category</div>
                        <div class="card-body">
                            <form action="{{url('category/update/'.$categories->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="cate_name">Update Name</label>
                                    <input type="text" name="category_name" class="form-control" id="cate_name"
                                        aria-describedby="emailHelp" placeholder="Enter email" value="{{$categories->category_name}}">
                                    @error('category_name')
                                    <small id="emailHelp" class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Edit Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>