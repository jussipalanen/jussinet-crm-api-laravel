@extends('layout.dashboard')
@section('content')
    <h2>Add product category</h2>
    <form action="{{ $url }}" method="post" enctype="multipart/form-data">

        @if (session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name ?? '' }}">
            @error('name')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $product->description ?? '' }}</textarea>
            @error('description')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" name="submit"
                class="btn btn-primary">{{ $mode == 'create' ? 'Create' : 'Edit' }}</button>
            <button type="reset" name="reset" class="btn btn-primary">Reset</button>
        </div>
    </form>
@endsection
