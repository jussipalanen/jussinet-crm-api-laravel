@extends('layout.dashboard')
@section('content')
    <h2>Add product</h2>
    <form action="{{ url('/products/add') }}" method="post" enctype="multipart/form-data">

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
            <label for="featured_image" class="form-label">Featured image</label>
            <input type="file" name="featured_image" id="featured_image" class="form-control">
            @error('featured_image')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <p>Preview image:</p>
            @if ( isset( $product->featured_image ) )
                <img class="img-thumbnail rounded product-featured-image" src="{{ Storage::url( 'app/' . $product->featured_image) }}">
            @endif
        </div>


        <div class="mb-3">
            <label for="gallery" class="form-label">Gallery</label>
            <input type="file" name="gallery[]" id="gallery" class="form-control">
            @error('gallery')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="regular_price" class="form-label">Regular price</label>
            <input type="number" class="form-control" name="regular_price" id="regular_price" min="0" max="99999999"
                step="1" placeholder="1.00">
            @error('regular_price')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sale_price" class="form-label">Sale price</label>
            <input type="number" class="form-control" name="sale_price" id="sale_price" min="0" max="99999999"
                step="1" placeholder="">
            @error('sale_price')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Weight</label>
            <input type="number" class="form-control" name="weight" id="weight" min="0" max="99999999"
                step="1" placeholder="">
            @error('weight')
                <span class="invalid-feedback d-block" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>


        <div class="mb-3">
            <label for="show" class="form-label">Publish</label>
            <select class="form-control" name="show" id="show">
                <option value="0">No</option>
                <option value="1" selected>Yes</option>
            </select>
        </div>


        <div class="mb-3">
            <button type="submit" name="submit" class="btn btn-primary">Create</button>
            <button type="reset" name="reset" class="btn btn-primary">Reset</button>
        </div>
    </form>
@endsection
