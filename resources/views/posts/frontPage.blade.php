@extends('layouts.app')

@section('content')
    @forelse ($posts as $post)
        <div class="view_container">
            <div class="view_profile">
                <div class="view_image">
                    <img src="{{ url('storage', $post->user->profile->image) ?? '' }}">
                </div>
                <div class="view_profile_name">
                    <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->username ?? '' }}
                    </a>
                </div>
            </div>
            <div class="view_profile_post_image">
                <a href="{{ route('profile.show', $post->user->id) }}">
                    <img src="{{ asset('storage/' . $post->image ?? '') }}">
                </a>
            </div>
            <div class="view_description">
                {!! $post->caption !!}

            </div>
            <div class="view_time">
                <small>{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
        </div>
    @empty
        <div class="view_container alert alert-primary">
           None of your followers has post
        </div>
    @endforelse
    <div class=" pagination">
        <div class="innert_pagination">
            {{  $posts->links()  }}
        </div>
    </div>
@endsection
