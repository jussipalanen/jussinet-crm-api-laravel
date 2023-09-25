@extends('layout.dashboard')
@section('content')
    <h2>Posts</h2>

    <div class="row mb-3">
        <form action="{{ url('/posts') }}" method="get">
            <div class="mb-3 col">
              <label for="search" class="form-label">Search</label>
              <input type="text" class="form-control" name="s" id="search" placeholder="Search..." value="{{ $s }}">
            </div>

            <div class="mb-3 col">
                <label for="limit" class="form-label">Show</label>
                <select class="form-select form-select-lg" name="limit" id="limit">
                    <option {{ $limit == 1 ? 'selected' : ''}}>1</option>
                    <option {{ $limit == 5 ? 'selected' : ''}}>5</option>
                    <option {{ $limit == 10 ? 'selected' : ''}}>10</option>
                    <option {{ $limit == 50 ? 'selected' : ''}}>50</option>
                    <option {{ $limit == 100 ? 'selected' : ''}}>100</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <td scope="col">Select all
                    <input type="checkbox" name="select-all-items" id="select-all-items">
                </td>
                <td scope="col">Name</td>
                <td scope="col">Featured Image</td>
                <td scope="col">Content</td>
                <td scope="col">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td scope="row">
                        <input type="checkbox" name="post[$post->id]" id="product-{{ $post->id }}" value="{{ $post->id }}">
                    </td>
                    <td scope="row">{{ $post->name }} </td>
                    <td><img class="img-thumbnail rounded product-featured-image" src="{{ Storage::url( 'app/' . $post->featured_image) }}"> </td>
                    <td>{{ $post->content }} </td>
                    <td>
                        <a class="btn btn-primary" href="{{ url("/posts/edit/{$post->id}") }}">Edit</a>

                        <form method="post" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('Do you really want to delete this post?');">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        {!! $posts->appends(request()->input())->links() !!}
    </div>

    <div class="d-flex">
        <a class="btn btn-primary" href="{{ url('/posts/create') }}">Create post</a>
    </div>
@endsection
