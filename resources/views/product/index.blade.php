@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All Products') }}
                        <a style="float: right;" href="{{ route('products.create') }}" class="btn btn-success btn-sm">Add Product</a>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <strong class="text-success">{{ session()->get('success') }}</strong>
                        @endif
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Price</th>
                                    <th>image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $row)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $row->product_name }}</td>
                                        <td>{{ $row->subcategory->category->category_name }}</td>
                                        <td>{{ $row->subcategory->subcategory_name}}</td>
                                        <td>{{ $row->new_price }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $row->image) }}" alt="" width="50" height="50">
                                        </td>

                                        <td>
                                            {{-- edit item --}}
                                            <a href="{{ route('products.edit', $row->product_slug) }}"
                                                class="btn btn-info btn-sm">Edit</a>

                                                {{-- delete item --}}
                                            <form action="{{ route('products.destroy', $row->product_slug) }}"method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
