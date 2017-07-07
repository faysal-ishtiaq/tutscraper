@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 site-list">
            <h3><a href="{{url('/admin/sites/'.$site->id)}}">{{$site->name}}</a></h4>
            <h4>Categories</h4>
            @include('partials.category_list')
        </div>        
    </div>
</div>
@endsection
