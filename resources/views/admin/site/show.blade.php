@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 site-list">
            <h4>Sites</h4>
            @include('admin.partials.category_list')
        </div>        
    </div>
</div>
@endsection
