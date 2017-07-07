@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 create-site">
            <h4>Create site</h4>
            <form method="POST" action="{{url('/admin/sites')}}">
                {!!csrf_field()!!}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" name="url" value="" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-rught">Create</button>
                </div>
            </form>
        </div>

        <div class="col-md-6 site-list">
            <h4>All sites</h4>
            @include('admin.partials.site_list')
        </div>        
    </div>
</div>
@endsection
