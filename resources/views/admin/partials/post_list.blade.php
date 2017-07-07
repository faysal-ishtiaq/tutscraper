<ul class="list m0 p0">
    @foreach($posts->chunk(2) as $chunk)
    <li class="item clearfix" style="list-style: none;">
        <div class="row m0 p0">
        @foreach($chunk as $post)
            <div class="col-md-6 pl0">
                <div class="post">
                    <h3 class="title"><a href="{{$post->link}}">{{$post->title}}</a></h3>
                    <ul class="about list-inline">
                        <li class="list-inline-item"><label for="">Author: </label><a href="{{$post->author_link}}">{{$post->author}}</a></li>
                        <li class="list-inline-item"><label for="">Published On:</label>{{$post->published_on}}</li>
                    </ul>
                    <p>{{$post->excerpt}}</p>
                    <ul class="about list-inline">
                        <li class="list-inline-item"><label for="">Comments: {{$post->comment_count}}</li>
                        <li class="list-inline-item"><label for="">likes: {{$post->like_count}}</li>
                    </ul>
                </div>
            </div>
        @endforeach
        </div>
    </li>
    @endforeach
</ul>


<div class="row" style="text-align: center;">
    {{ $posts->links() }}
</div>