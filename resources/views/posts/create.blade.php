@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Add New Post</h3>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col-sm-10">
                    <label for="caption" class="col-form-label">Title</label>
                    <input type="text" name="caption" id="caption" 
                    class="form-control @error('caption') border border-danger
                    @enderror" value="{{ old('caption') }}" autocomplete="off">
                    <small class="text-danger">
                      @error('caption')
                          {{ $message }}
                      @enderror
                    </small>
                </div>
                {{-- =============================== --}}
                <div class="col-sm-10">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') border border-danger @enderror" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    <small class="text-danger">
                        @error('description')
                            {{ $message }}
                        @enderror
                      </small>
                </div>
                {{-- =============================== --}}
                <div class="col-sm-10">
                    <label for="image" class="col-form-label">Image</label>
                    <input type="file" name="image" class="form-control-file @error('image') border border-danger @enderror" id="iamge">
                    <small class="text-danger">
                        @error('image')
                            {{ $message }}
                        @enderror
                      </small>
                </div>
                <div class="col-sm-10 mt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
@endsection
