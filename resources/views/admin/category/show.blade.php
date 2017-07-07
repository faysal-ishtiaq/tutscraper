@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 site-list">
            <h3><a href="{{url('/admin/sites/'.$category->site->id)}}">{{$category->site->name}}</a></h3>
            <h4>Category: <a href="{{url('/admin/categories/'.$category->id)}}">{{$category->name}}</a></h4>
            <h4>Posts: </h4>
            @include('admin.partials.post_list')
        </div>        
    </div>
</div>
@endsection
