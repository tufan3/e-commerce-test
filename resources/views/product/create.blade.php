@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Product') }}
                    <a style="float: right;" href="{{ route('products.index') }}" class="btn btn-danger btn-sm">All Products</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                         {{-- Product Name --}}
                         <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" placeholder="Product Name" value="{{ old('product_name') }}">
                            @error('product_name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>


                        <div class="mb-3 row">
                            {{-- Category Selection --}}
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category Name</label>
                                <select id="category" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">----SELECT----</option>
                                    @foreach($category as $cat_data)
                                        <option value="{{ $cat_data->id }}">{{ $cat_data->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                            </div>

                            {{-- Subcategory Selection --}}
                            <div class="col-md-6">
                                <label for="subcategory_id" class="form-label">Subcategory Name</label>
                            <select id="subcategory" name="subcategory_id" class="form-control  @error('subcategory_id') is-invalid @enderror">
                            </select>
                            @error('subcategory_id')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            </div>
                        </div>


                        <div class="mb-3 row">
                            {{-- New Price --}}
                            <div class="col-md-6">
                                <label for="new_price" class="form-label">New Price</label>
                                <input type="text" class="form-control @error('new_price') is-invalid @enderror" name="new_price" placeholder="New Price" value="{{ old('new_price') }}">
                                @error('new_price')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- Old Price --}}
                            <div class="col-md-6">
                                <label for="old_price" class="form-label">Old Price</label>
                            <input type="text" class="form-control @error('old_price') is-invalid @enderror" name="old_price" placeholder="Old Price" value="{{ old('old_price') }}">
                            @error('old_price')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                            </div>
                        </div>

                        {{-- Product Image --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Product Image" value="{{ old('image') }}">
                            @error('image')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add the script for AJAX here -->
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category').on('change', function() {
            var categoryId = $(this).val();
            if(categoryId) {
                $.ajax({
                    url: '{{ route("getSubcategories", ":categoryId") }}'.replace(':categoryId', categoryId),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#subcategory').empty();
                        $('#subcategory').append('<option value="">----SELECT----</option>');
                        $.each(data, function(key, value) {
                            $('#subcategory').append('<option value="'+ value.id +'">'+ value.subcategory_name +'</option>');
                        });
                    }
                });
            } else {
                $('#subcategory').empty();
            }
        });
    });
</script>
@endpush
@endsection
