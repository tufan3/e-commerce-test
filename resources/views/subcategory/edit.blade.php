@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Sub Category') }}
                    <a style="float: right;" href="{{ route('subcategories.index') }}" class="btn btn-danger btn-sm">All Sub Category</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('subcategories.update',$subcategory->subcategory_slug) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- select category name --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Catrgory Name</label>
                            <select name="category_id" id="" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">----SELECT----</option>
                                @foreach($category as $sub_data)
                                <option value="{{ $sub_data->id }}"
                                    @if ($sub_data->id == $subcategory->category_id)
                                        selected
                                    @endif>
                                    {{ $sub_data->category_name }}
                                </option>
                            @endforeach
                            </select>
                            @error('category_id')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>

                          <div class="mb-3">
                            <label for="subcategory_name" class="form-label">Sub Catrgory Name</label>
                            <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" name="subcategory_name" placeholder="Sub Category Name" value="{{ old('subcategory_name', $subcategory->subcategory_name) }}">

                            @error('subcategory_name')
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
@endsection
