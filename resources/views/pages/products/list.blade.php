@extends('layout.dashboard')
@section('content')
    <h2>Products</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <td scope="col">Name</td>
                <td scope="col">Image</td>
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
                    <td>{{ $product->image }} </td>
                    <td>{{ $product->description }} </td>
                    <td>{{ $product->weight }} </td>
                    <td>{{ $product->regular_price }} </td>
                    <td>{{ $product->sale_price }} </td>
                    <td>
                        <button class="btn btn-primary">Edit</button>
                        <button class="btn btn-danger">Delete</button>
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
