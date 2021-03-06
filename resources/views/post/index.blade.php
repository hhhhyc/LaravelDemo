
@extends('common.layout')

@section('content')

<div class="col-sm-8 blog-main">
            <div>
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                    </ol><!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="public/img/bg.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="public/img/image1.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="public/img/image8.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="public/img/image10.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#carousel-example" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
            <div style="height: 20px;"></div>
            <div>
                @foreach($posts as $post)
                <div class="blog-post">
                    <h2 class="blog-post-title"><a href="/laraveldemo/posts/show/{{$post->id}}" >{{$post->title}}</a></h2>
                    <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by <a href="/laraveldemo/user/{{$post->user->id}}/show">{{$post->user->name}}</a></p>

                    <p>{!! \Str::limit($post->content,100,'...')!!}</p>
                    <p>
                        <a href="/laraveldemo/posts/show/{{$post->id}}">查看详情</a>
                    </p>
                    <p class="blog-post-meta">赞 {{$post->zans_count}} | 评论 {{$post->comments_count}}</p>
                </div>
                @endforeach
{{--                分页--}}
                {{$posts->links()}}
            </div><!-- /.blog-main -->
        </div>
    @include('common.sidebar')
@endsection
