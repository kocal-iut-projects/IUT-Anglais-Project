@extends('layouts.default', [
    'title' => e($video->title) . ' | Amarantia.fr',
    'description' => e($video->description) . ' | Video hosted on Amarantia.fr'
])

@section('content')

    <div class="col-md-8">
        <div class="embed-responsive embed-responsive-16by9">
            <video controls>
                <source type="video/webm" src="{{ asset('upload/videos/' . $video->file) }}"/>
                <source type="video/mp4" src="{{ asset('upload/videos/' . $video->file) }}"/>
            </video>
        </div>

        <h2 class="video__title">{{ $video->title }}</h2>

        <p class="video__description">
            {{ $video->description }}
        </p>

        <div class="user">
            <img class="avatar avatar-small" src="{{ asset('upload/' . $video->user->avatar_url) }}"
                 alt="Avatar de {{ $video->user->username }}">
            Sent by <b>{{ $video->user->username }}</b>, on
            <time pubdate="{{ $video->created_at }}">{{ $video->created_at->format('d/m/y \a\t h:i:s') }}</time> in <i>{{ $video->category->category }}</i>.
        </div>
    </div>

    <div class="col-md-4">
        <div class="add-comment">
            {!! BootForm::open()->action(route('comment::add', ['video_tag' => $video->tag])) !!}
            {!! BootForm::textarea(null, 'comment')->placeholder('Write here your comment...')->rows(2) !!}
            {!! BootForm::submit("<i class='fa fa-btn fa-upload'></i> Send", 'btn btn-primary btn-block') !!}
            {!! BootForm::close() !!}
        </div>

        <hr>

        <div class="comments">
            @if(count($video->comments) == 0)
                <p class="alert alert-info">
                    There is no comment yet...
                </p>
            @else
                @foreach($video->comments as $comment)
                    <p class="user">
                        <img class="avatar avatar-small" src="{{ asset('upload/' . $comment->user->avatar_url) }}"
                             alt="Avatar de {{ $comment->user->username }}">
                        Written by <b>{{ $comment->user->username }}</b>, on
                        <time pubdate="{{ $comment->created_at }}">{{ $comment->created_at->toDayDateTimeString() }}</time>
                    </p>

                    <p>{{ $comment->comment }}</p>

                    <hr>
                @endforeach
            @endif
        </div>

    </div>
@stop
