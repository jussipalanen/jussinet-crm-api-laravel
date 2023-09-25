@extends('layout.dashboard')
@section('content')
    <h2>{{ $form_title }}</h2>
    <form action="{{ $url }}" method="post" enctype="multipart/form-data">

        @if (session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $post->name ?? '' }}">
            @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ $post->content ?? '' }}</textarea>
            @error('content')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="featured_image" class="form-label">Featured image</label>
            <input type="file" name="featured_image" id="featured_image" class="form-control">
            @if (isset($post->featured_image))
                <input type="hidden" name="uploaded_featured_image" value="{{ $post->featured_image }}">
            @endif
            @error('featured_image')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <p>Preview image:</p>
            @if (isset($post->featured_image))
                <img class="img-thumbnail rounded product-featured-image"
                    src="{{ Storage::url('app/' . $post->featured_image) }}">
            @endif
        </div>
        <div class="mb-3">
            <label for="show" class="form-label">Publish</label>
            <select class="form-control" name="show" id="show">
                <option value="1" {{ isset($post->show) && $post->show == true ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ isset($post->show) && $post->show == false ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" name="submit"
                class="btn btn-primary">{{ $mode == 'create' ? 'Create' : 'Edit' }}</button>
            <button type="reset" name="reset" class="btn btn-primary">Reset</button>
        </div>
    </form>
    @php
        $options = [
            [
                'selector' => 'textarea#content'
            ]
        ];
    @endphp
    @include('scripts.tinymce', [$options])
@endsection
