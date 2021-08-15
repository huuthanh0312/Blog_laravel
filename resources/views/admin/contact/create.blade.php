@extends('admin.admin_master')

@section('admin')

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Add Contact</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('store.contact')}}" >
                        @csrf 
                        <div class="form-group">
                            <label for="email">Contact Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter address">
                            
                        </div>
                        <div class="form-group">
                            <label for="phone">Contact Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter address">
                            
                        </div>
                        <div class="form-group">
                            <label for="address">Contact Address</label>
                            <textarea class="form-control" name="address" id="address" rows="4"></textarea>
                            
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