@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="about-site">
                <h2>About</h2>
                <p>This website crawls through websites and collects posts based on selected category. And show them categorically.</p>    
            </div>
            <div class="website-list">
                <div>
                    <h4>List of websites:</h4>
                    <ul>
                        <li><a href="http://pyimagesearch.com">pyimagesearch.com</a></li>
                    </ul>    
                </div>
                
                <div class="more-to-come pull-right">
                    <a href="scotch.io">scotch.io...</a>
                    <button type="button" class="btn btn-success btn-lg">Coming soon</button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h3>What was used?</h3>
            <ul class="list">
                <li class="item">Laravel Framework</li>
                <li class="item">Bootstrap</li>
                <li class="item">Bootstrap DateTimePicker</li>
                <li class="item">jQuery</li>
                <li class="item">Laravel Queue</li>
                <li class="item">Laravel Task Scheduler/Scheduled Jobs (Cron Job)</li>
                <li class="item">Laravel CRUD using ORM</li>
                <li class="item">Laravel One to Many, Many to Many relationship.</li>
            </ul>
        </div>
    </div>
</div>
@endsection
