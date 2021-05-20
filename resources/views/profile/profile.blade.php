@extends('layouts.app')

@section('content')
    <div class="main_profile_container">
        <div class="main_profile_grid">
            <div class="main_profile_image">
                <img src="{{ url('storage', $user->profile->image ?? 'placeholder/placeholder.png') }}">
            </div>
            <div class="main_profile_name">
                <div class="innser_profile">
                    <h5>{{ Str::ucfirst($user->username ?? '') }}</h5>
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                <div class="main_profile_followers">
                    <ul>
                        <li>
                            <strong class="pr-1">{{ $postCount }}</strong>Posts
                        </li>
                        <li>
                            <strong class="pr-1">{{ $followerCount }}</strong>followers
                        </li>
                        <li>
                            <strong class="pr-1">{{ $followingCount}}</strong>following
                        </li>
                    </ul>
                </div>
                <div class="main_profile_bio">
                    <span> {{ $user->profile->title ?? 'Bio' }}</span>
                    <span>
                        {{ $user->profile->description ?? 'No Description, Edit Profile' }}
                    </span>
                    <a href="#">{{ $user->profile->url ?? 'N/A' }}</a>
                </div>
            </div>
        </div>
    </div>
    {{-- contents --}}
    <div class="profile_contents">
        {{-- main posts --}}
        <div class="profile_btn">
            @can('update', $user->profile)
                <div class="btns">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">Add New Post</a>
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                </div>
            @endcan
        </div>
        <div class="main_profile_posts">
            <div class="main_profile_contents">
                @forelse ($user->posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}">
                        <img src="{{ asset('storage/' . $post->image) }}" class="w-100">
                    </a>
                @empty
                    No posts available
                @endforelse
            </div>
        </div>
    @endsection
