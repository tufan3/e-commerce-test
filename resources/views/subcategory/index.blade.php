@extends('home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All Sub Category') }}
                        <a style="float: right;" href="{{ route('subcategories.create') }}" class="btn btn-success btn-sm">Add Sub
                            Category</a>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <strong class="text-success">{{ session()->get('success') }}</strong>
                        @endif
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategory as $key => $row)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $row->category->category_name }}</td>
                                        <td>{{ $row->subcategory_name }}</td>
                                        <td>{{ $row->subcategory_slug }}</td>
                                        <td>
                                            {{-- edit item --}}
                                            <a href="{{ route('subcategories.edit', $row->subcategory_slug) }}"
                                                class="btn btn-info btn-sm">Edit</a>

                                                {{-- delete item --}}
                                            <form action="{{ route('subcategories.destroy', $row->subcategory_slug) }}"method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sub category?');">Delete</button>
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
