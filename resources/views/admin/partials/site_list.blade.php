<ul class="list">
    @foreach($sites as $site)
    <li class="item clearfix" style="list-style: none;">
        <a href="{{url('admin/sites/'.$site->id)}}">{{$site->name}}</a>
        <ul class="list-inline pull-right">
            <li class="list-inline-item">
                <a href="{{url('/admin/sites/'.$site->id.'/edit')}}" class="pull-right btn btn-primary"><i clsas="fa fa-edit"></i> Edit</a>
            </li>
            <li class="list-inline-item">
                <a href="{{url('/admin/sites/'.$site->id.'/listPages')}}" class="pull-right btn btn-success"><i class="fa fa-list"></i> List Pages</a>
            </li>
            <li class="list-inline-item">
                <form action="{{url('admin/sites/'.$site->id)}}" method="POST" class="pull-right">
                    {{method_field('DELETE')}}
                    {!!csrf_field()!!}
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
                </form>
            </li>
        </ul>
    </li>
    @endforeach
</ul>

{{ $sites->links() }}