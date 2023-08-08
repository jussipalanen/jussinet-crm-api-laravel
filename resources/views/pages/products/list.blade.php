@extends('layout.dashboard')
@section('content')
    <h2>Products</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <td scope="col">Name</td>
                <td scope="col">Featured Image</td>
                <td scope="col">Description</td>
                <td scope="col">Weight</td>
                <td scope="col">Regular Price</td>
                <td scope="col">Sale Price</td>
                <td scope="col">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td scope="row">{{ $product->name }} </td>
                    <td><img class="img-thumbnail rounded product-featured-image" src="{{ Storage::url( 'app/' . $product->featured_image) }}"> </td>
                    <td>{{ $product->description }} </td>
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
