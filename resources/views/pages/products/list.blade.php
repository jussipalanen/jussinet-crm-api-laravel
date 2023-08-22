@extends('layout.dashboard')
@section('content')
    <h2>Products</h2>

    <div class="row mb-3">
        <form action="{{ url('/products') }}" method="get">
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
                <td scope="col">Description</td>
                <td scope="col">Product category</td>
                <td scope="col">Weight</td>
                <td scope="col">Regular Price</td>
                <td scope="col">Sale Price</td>
                <td scope="col">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td scope="row">
                        <input type="checkbox" name="product[$product->id]" id="product-{{ $product->id }}" value="{{ $product->id }}">
                    </td>
                    <td scope="row">{{ $product->name }} </td>
                    <td><img class="img-thumbnail rounded product-featured-image" src="{{ Storage::url( 'app/' . $product->featured_image) }}"> </td>
                    <td>{{ $product->description }} </td>
                    <td>{{ $product->product_category }} </td>
                    <td>{{ $product->weight }} </td>
                    <td>{{ $product->regular_price }} </td>
                    <td>{{ $product->sale_price }} </td>
                    <td>
                        <a class="btn btn-primary" href="{{ url("/products/edit/{$product->id}") }}">Edit</a>

                        <form method="post" action="{{ route('products.destroy', $product->id) }}" onsubmit="return confirm('Do you really want to delete this product?');">
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
        {!! $products->links() !!}
    </div>

    <div class="d-flex">
        <a class="btn btn-primary" href="{{ url('/products/add') }}">Add product</a>
    </div>
@endsection
