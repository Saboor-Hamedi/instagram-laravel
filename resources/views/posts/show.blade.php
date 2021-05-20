@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="{{ asset('storage/' . $post->image ?? '') }}" class="w-100">
            </div>
            <div class="col-4">
                <div class="d-flex align-items-center ">
                    <div class="mr-3">
                        <img src="{{ url('storage', $post->user->profile->image) ?? '' }}" width="w-100"
                            class="rounded-circle " style="max-width: 50px">
                    </div>
                    <div>
                        <a href="{{ route('profile.show', $post->user->id) }}" class="font-weight-bold">{{ $post->user->username ?? '' }}
                        </a>
                        <a href="#" class="font-weight-bold">.Follow </a>
                    </div>
                </div>
                <hr>
                <div>
                   <span>
                        <p><a href="{{ route('profile.show', $post->user->id) }}" class="font-weight-bold">{{ $post->user->username ?? '' }}</a>
                            {!! $post->caption !!}
                        </p>
                   </span>
                  
                </div>
            </div>
        </div>
    </div>
@endsection
