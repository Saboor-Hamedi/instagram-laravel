@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Add New Post</h3>
        <form method="POST" 
        action="{{ route('profile.update', [$user->id]) }}"
          enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="title" class="col-form-label">Title</label>
                    <input type="text" name="title" id="title" 
                    class="form-control @error('title') border border-danger
                    @enderror" value="{{ old('title') ?? $user->profile->title }}" autocomplete="off">
                    <small class="text-danger">
                      @error('title')
                          {{ $message }}
                      @enderror
                    </small>
                </div>
                <div class="col-sm-6">
                    <label for="description" class="col-form-label">Description</label>
                    <input type="text" name="description" id="description" 
                    class="form-control @error('description') border border-danger
                    @enderror" value="{{ old('description') ?? $user->profile->description }}" autocomplete="off">
                    <small class="text-danger">
                      @error('description')
                          {{ $message }}
                      @enderror
                    </small>
                </div>
            </div>
            {{-- =============================== --}}
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="url" class="col-form-label">URL</label>
                    <input type="text" name="url" id="url" 
                    class="form-control @error('url') border border-danger
                    @enderror" value="{{ old('url') ?? $user->profile->url }}" autocomplete="off">
                    <small class="text-danger">
                      @error('url')
                          {{ $message }}
                      @enderror
                    </small>
                </div>
                {{-- =================================== --}}
                <div class="col-sm-6">
                    <label for="image" class="col-form-label">Profile</label>
                    <input type="file" name="image" class="form-control-file @error('image') border border-danger @enderror" id="iamge">
                    <small class="text-danger">
                        @error('image')
                            {{ $message }}
                        @enderror
                      </small>
                </div>
            </div>
            <div class="col-sm-10 mt-4">
                <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
