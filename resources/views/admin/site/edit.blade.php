@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 create-site">
            <h4>Create site</h4>
            <form method="POST" action="{{url('admin/sites/'.$site->id)}}">
                {!!csrf_field()!!}
                {{method_field('PUT')}}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{$site->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" name="url" value="{{$site->url}}" class="form-control">
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="publish" @if($site->publish) checked="checked"@endif>
                        Publish
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
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
