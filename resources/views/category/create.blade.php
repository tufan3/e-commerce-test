@extends('home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}
                    <a style="float: right;" href="{{ route('categories.index') }}" class="btn btn-danger btn-sm">All Category</a>
                </div>
                <div class="card-body">
                    @if(session()->has('success'))
                    <strong class="text-success">{{ session()->get('success') }}</strong>
                @endif
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        {{-- category name --}}
                        <div class="mb-3">
                          <label for="category_name" class="form-label">Catrgory Name</label>
                          <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" placeholder="Category Name" value="{{ old('category_name') }}">
                          @error('category_name')
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
