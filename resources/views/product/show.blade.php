@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" class="img-fluid rounded border border-success" style="max-height: 400px; object-fit: cover; width: 100%;">
                </div>

                <div class="col-md-6">
                    <h2>{{ $product->product_name }}</h2>

                    <p>{{ $product->description }}</p>

                    <p>
                        <span class="text-muted"><del>{{ $product->old_price }} BDT</del></span>
                        <strong>{{ $product->new_price }} BDT</strong>
                    </p>

                    <p>Category: {{ $product->subcategory->category->category_name }}</p>
                    <p>Subcategory: {{ $product->subcategory->subcategory_name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
