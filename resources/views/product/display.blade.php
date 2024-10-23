@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-3">Products by Subcategory</h2>

            @foreach($categories as $category)
                @php
                    $flag = false;
                    foreach ($category->subcategories as $subcategory) {
                        if ($subcategory->products->isNotEmpty()) {
                            $flag = true;
                            break;
                        }
                    }
                @endphp

                @if($flag)
                    <div class="mb-3">
                        <h4 class="bg-body-secondary p-2">{{ $category->category_name }}</h4>

                        @foreach($category->subcategories as $subcategory)
                            @if($subcategory->products->isNotEmpty())
                                <h5 class="mt-2">{{ $subcategory->subcategory_name }}</h5>

                                <div class="row">
                                    @foreach($subcategory->products as $product)
                                        <div class="col-md-3 mb-3">
                                            <div class="card h-100">

                                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 150px; object-fit: cover;width: 150px:">

                                                <div class="card-body">
                                                    <a style="text-decoration: none" href="{{ route('products.show', $product->product_slug) }}"><h5 class="card-title">{{ $product->product_name }}</h5></a>

                                                    <!-- Product Description -->
                                                    {{-- <p class="card-text">{{ Str::limit($product->description, 100) }}</p> --}}

                                                    <p class="card-text">
                                                        <span class="text-muted"><del>{{ $product->old_price }} BDT</del></span><br>
                                                        <strong>{{ $product->new_price }} BDT</strong>
                                                    </p>

                                                    <!-- View Product Button with Slug URL -->
                                                    {{-- <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary">View Product</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
