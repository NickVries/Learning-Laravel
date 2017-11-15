@extends('layouts.master')

@section('content')
    <div class="col-sm-8 blog-main">
        <h1>
            {{ $post->title }}
        </h1>
        <p class="blog-post-meta">
            {{ $post->created_at->toFormattedDateString() }}
        </p>
        {{ $post->body }}

        <hr>

        <div class="comments">
            <h5>Comments:</h5>
            <ul class="list-group">
                @foreach ($post->comments as $comment)
                    <li class="list-group-item">
                        <strong>
                            {{ $comment->user->name }}
                            {{ $comment->created_at->diffForHumans() }}: &nbsp;
                        </strong>

                        {{ $comment->body }}
                    </li>
                @endforeach
            </ul>
        </div>

        @if (auth()->check())
            <hr>
            <div class="card">
                <div class="card-block">
                    <form action="/posts/{{ $post->id }}/comments" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" placeholder="Your comment here" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add comment</button>
                        </div>
                    </form>
                    @include('layouts.errors')
                </div>
            </div>
        @endif
    </div>
@endsection

