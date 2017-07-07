@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 create-category">
            <h4>Create category</h4>
            <form method="POST" action="{{url('admin/categorys/'.$category->id)}}">
                {!!csrf_field()!!}
                {{method_field('PUT')}}
                
                <div class="form-group">
                    <label for="site_id">Select site</label>
                    <select class="selectpicker" name="site_id" data-live-search="true">
                        @foreach($sites as $site)
                        <option value="{{$site->id}}"
                            @if($site->id == $category->site_id)
                            selected="selected"
                            @endif
                            data-tokens="{{$site->name}}"
                        >{{$site->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" name="link" value="{{$category->link}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="link">Page count</label>
                    <input type="text" name="link" value="{{$category->link}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="link">Pagination pattern</label>
                    <input type="text" name="link" value="{{$category->link}}" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
            </form>
        </div>

        <div class="col-md-6 category-list">
            <h4>All categories</h4>
            @include('admin.partials.category_list')
        </div>        
    </div>
</div>
@endsection
