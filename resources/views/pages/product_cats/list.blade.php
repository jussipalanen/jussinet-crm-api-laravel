@extends('layout.dashboard')
@section('content')
    <h2>Product categories</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <td scope="col">Select all
                    <input type="checkbox" name="select-all-items" id="select-all-items">
                </td>
                <td scope="col">Name</td>
                <td scope="col">Description</td>
                <td scope="col">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($product_categories as $product_category)
                <tr>
                    <td scope="row">
                        <input type="checkbox" name="product[$product_category->id]" id="product-{{ $product_category->id }}" value="{{ $product_category->id }}">
                    </td>
                    <td scope="row">{{ $product_category->name }} </td>
                    <td>{{ $product_category->description }} </td>
                    <td>
                        <a class="btn btn-primary" href="{{ url("/product_cats/edit/{$product_category->id}") }}">Edit</a>

                        <form method="post" action="{{ route('product_cats.destroy', $product_category->id) }}" onsubmit="return confirm('Do you really want to delete this product category?');">
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
        {!! $product_categories->appends(request()->input())->links() !!}
    </div>

    <div class="d-flex">
        <a class="btn btn-primary" href="{{ url('/product_cats/add') }}">Add product category</a>
    </div>
@endsection
